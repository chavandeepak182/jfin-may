<?php

namespace App\Http\Controllers;

use App\Mail\PasswordResetLinkMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use App\Models\PasswordResets;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class FrontendController extends Controller
{
    //     public function userLogin(Request $req)
    // {
    //     // Validate the input
    //     $req->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|min:6',
    //     ], [
    //         'email.required' => 'The email field is required.',
    //         'email.email' => 'Please provide a valid email address.',
    //         'password.required' => 'The password field is required.',
    //         'password.min' => 'Password must be at least 6 characters.',
    //     ]);

    //     $email = $req->input('email');
    //     $p = md5($req->input('password'));

    //     // Fetch user data including the password
    //     $users = DB::select('
    //         SELECT u.id, u.name, u.email_id, u.password, p.mobile_no, r.id as role_id, r.name as role_name, u.is_email_verify
    //         FROM users u
    //         JOIN profile p ON u.id = p.user_id
    //         JOIN roles r ON r.id = u.role_id
    //         WHERE u.email_id = ?
    //     ', [$email]);

    //     if (count($users) === 0) {
    //         // Username (email) not found
    //         return redirect()->back()->with('error', 'Incorrect username.');
    //     }

    //     $user = $users[0]; // Assuming there is only one matching user

    //     // Check password and email verification
    //     if ($user->password !== $p) {
    //         // Password does not match
    //         return redirect()->back()->with('error', 'Incorrect password.');
    //     }

    //     if (!$user->is_email_verify) {
    //         // Email not verified
    //         return redirect()->back()->with('error', 'Email not verified.');
    //     }

    //     // Set session variables
    //     Session::put('username', $user->name);
    //     Session::put('role_name', $user->role_name);
    //     Session::put('user_id', $user->id);
    //     Session::put('role_id', $user->role_id);
    //     Session::put('email', $user->email_id);

    //     // Redirect based on role_id
    //     switch ($user->role_id) {
    //         case 5:
    //             return redirect('broker/allLoansApplications');
    //         case 4:
    //             return redirect('admin/dashboard');
    //         case 2:
    //             return redirect('agent/agentDashboard');
    //         case 3:
    //             return redirect('partner/partnerDashboard');
    //         case 1:
    //             return redirect('/');
    //         default:
    //             return redirect('/');
    //     }
    // }





    // bolgs


    
 public function blog(Request $request)
{
    $query = DB::table('blog')
        ->select(
            'blog.id',
            'blog.image',
            'blog.blog_name',
            'blog.description',
            'blog.slug',
            'blog.meta_title',
            'blog.meta_keywords',
            'blog.meta_description',
            'blog.created_at',
            'blog.updated_at',
            'blog.schema_markup',
            'blog.publish_date',
            'blog.tag',
            'blog.status',
            'blog.author_name',
            'blog.category_id',
            'blog_category.category_name'
        )
        ->leftJoin('blog_category', 'blog.category_id', '=', 'blog_category.pid')
        ->where('blog.status', 'active'); // Only active blogs

    // 🔍 Search filter
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('blog.blog_name', 'LIKE', '%' . $request->search . '%')
              ->orWhere('blog.description', 'LIKE', '%' . $request->search . '%')
              ->orWhere('blog_category.category_name', 'LIKE', '%' . $request->search . '%');
        });
    }

    // 🏷 Category filter
    if ($request->filled('category')) {
        $query->where('blog.category_id', $request->category);
    }

    $data['allIndustries'] = $query->paginate(12)->appends($request->all());

    // Fetch categories
    $data['categories'] = DB::table('blog_category')
        ->select('pid', 'category_name')
        ->get();

    return view('frontend.blog', $data);
}













public function showBlog($slug)
{
    // Main blog
    $blog = DB::table('blog')
        ->join('blog_category', 'blog.category_id', '=', 'blog_category.pid')
        ->select('blog.*', 'blog_category.category_name as category_name')
        ->where('blog.slug', $slug)
        ->first();

    if (!$blog) {
        abort(404);
    }

    // Related blogs
    $relatedBlogs = DB::table('blog')
        ->select('id','blog_name','slug','image','description','created_at','category_id')
        ->where('slug', '!=', $slug)
        ->where('category_id', $blog->category_id)
        ->latest()
        ->take(3)
        ->get()
        ->map(function($item) {
            $item->slug = (string) $item->slug; // ✅ Cast slug as string
            return $item;
        });

    // Latest blogs
    $latestBlogs = DB::table('blog')
        ->select('id','blog_name','slug','image','description','created_at','category_id')
        ->where('slug', '!=', $slug)
        ->latest()
        ->take(3)
        ->get()
        ->map(function($item) {
            $item->slug = (string) $item->slug; // ✅ Cast slug as string
            return $item;
        });

    return view('frontend.blog-details', compact('blog', 'relatedBlogs', 'latestBlogs'));
}


    public function userLogin(Request $request)
    {
        $login_type = $request->input('login_type');

        if ($login_type == 'email') {
            // Validation for email and password login
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);

            $user = User::where('email_id', $request->email)->first();

            if (!$user) {
                return back()->withErrors(['email' => 'The provided credentials do not match our records.'])
                    ->withInput($request->only('email'));
            }

            if (!Hash::check($request->password, $user->password)) {
                return back()->withErrors(['password' => 'Incorrect password.'])
                    ->withInput($request->only('email'));
            }

            if (!$user->is_email_verify) {
                return redirect()->back()
                    ->withErrors(['email' => 'Please verify your email address before logging in.'])
                    ->withInput($request->only('email'));
            }


            Auth::login($user);

            $sessionData = [
                'username' => $user->name,
                'role_name' => $user->role_name,
                'user_id' => $user->id,
                'role_id' => $user->role_id,
                'email' => $user->email_id,
            ];

            Session::put($sessionData);




            $redirectRoutes = [
                5 => 'allLoansApplications',
                4 => 'dashboard',
                2 => 'agentDashboard',
                3 => 'partnerDashboard',
                1 => 'loans.loans-list',
            ];

            if (array_key_exists($user->role_id, $redirectRoutes)) {
                return redirect()->route($redirectRoutes[$user->role_id]);
            }
        } elseif ($login_type == 'mobile') {
            // Validation for mobile number login (OTP)
            $validated = $request->validate([
                'mobile_no' => 'required|digits:10',
            ]);

            // Check if the mobile number exists
            $user = User::where('mobile_no', $request->mobile_no)->first();
            if (!$user) {
                return back()->withErrors(['mobile_no' => 'Mobile number not registered']);
            }
            $otp = rand(1000, 9999);

            $api_key = 'e6412792-3a27-11f0-a562-0200cd936042'; // Replace with your actual API key
            $phone_number = $user->mobile_no;
            $nowithcountrycode = '91' . $phone_number;

            $message = "4475 is your OTP to verify phone number at jfinserv.com. Please do not share OTP with anyone.";

            $url = "https://2factor.in/API/V1/$api_key/SMS/$nowithcountrycode/$otp/SMSOTP";

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => [
                    "From" => "JFINSE",
                    "To" => $nowithcountrycode,
                    "TemplateName" => "SMSOTP",
                    "Message" => $message
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                return back()->withErrors(['mobile_no' => 'Failed to send OTP. Please try again.']);
            }

            $response = json_decode($response);

            if ($response->Status === "Success") {
                $user->email_otp = $otp;
                $user->save();

                // Redirect to OTP verification page with phone number
                return redirect('verify-otp')->with([
                    'mobile_no' => $request->mobile_no,
                    'success' => 'OTP sent successfully to ' . $phone_number
                ]);
            } else {
                return back()->withErrors(['mobile_no' => 'Failed to send OTP: ' . $response->Details])->withInput();
            }
        }

        return back()->withErrors(['error' => 'Invalid login type selected']);
    }

    public function activate(Request $request)
    {
        if (!$request->has(['expires', 'id', 'token', 'signature'])) {

            $result =  array('status' => 'failed', 'message' => "Invalid verification link.");
            return view('frontend.account_activation', compact('result'));
        }
        if (!$request->hasValidSignature()) {
            $result =  array('status' => 'failed', 'message' => "The verification link has expired or is invalid.");
            return view('frontend.account_activation', compact('result'));
        }

        $userAuth = User::findOrFail($request->id);

        if ($userAuth->email_verified_at) {
            $result =  array('status' => 'failed', 'message' => "Your account is already activated...!");
            return view('frontend.account_activation', compact('result'));
        }

        if ($userAuth->email_verification_token !== $request->token) {
            $result =  array('status' => 'failed', 'message' => "Invalid verification token.");
            return view('frontend.account_activation', compact('result'));
        }

        if (now()->gt($userAuth->email_otp_expires_at)) {
            $result =  array('status' => 'failed', 'message' => "The verification link has expired.");
            return view('frontend.account_activation', compact('result'));
        }

        $userAuth->update([
            'email_verified_at' => now(),
            'email_verification_token' => null,
            'email_otp_expires_at' => null,
            'is_email_verify' => '1',
        ]);

        $result =  array('status' => 'success', 'message' => "Congratulation! Your account is activated successfully...!!!");
        return view('frontend.account_activation', compact('result'));
    }


    function reset_password_link(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'The Email Address field is required.',
            'email.email' => 'Please enter a valid email address.',
        ]);

        // Check if the user exists with that email
        $user = DB::table('users')->where('email_id', $request->email)->first();

        if (!$user) {
            return redirect('forgot')->with('error', 'Sorry, no user exists on our system with that email.');
        }

        // Generate token and expiration
        $token = Str::random(32);
        $expiration = Carbon::now()->addDay(); // Token valid for 24 hours

        // Save or update the token in the password_resets table
        PasswordResets::updateOrCreate(
            ['email' => $request->email],
            [
                'token' => $token,
                'exp_date' => $expiration,
                'user_id' => $user->id,
                'created_at' => now(),
            ]
        );

        // Construct reset link
        $resetLink = url("/reset_password/{$token}");
        \Log::info("Reset link generated: {$resetLink} for user: {$user->email_id}");
        // Send email (using existing controller method)
        Mail::to($request->email)->send(new PasswordResetLinkMail($user->name, $resetLink));
        \Log::info("Password reset link sent to: {$request->email}");
        return redirect('forgot')->with('status', 'We sent an email to your registered email-id to help you recover your account. Please check your inbox for the reset link.');
    }


    public function reset_password($auth_id)
    {
        $user = DB::table('password_resets')->where('token', $auth_id)->first();

        if (!$user) {
            return redirect('forgot')->with('error', 'Authentication failed! Invalid or tampered link.');
        }

        $currentDateTime = Carbon::now();

        if (Carbon::parse($user->exp_date)->lt($currentDateTime)) {
            return redirect('forgot')->with('error', 'The link has expired. It was only valid for 24 hours.');
        }

        // if ($user->is_verified == 1) {
        //     return redirect('forgot')->with('error', 'This link has already been used. Please request a new one.');
        // }

        // Store email, user_id, and token in session for use in the reset form
        Session::put('email_id', $user->email);
        Session::put('user_id', $user->user_id);
        Session::put('auth_id', $auth_id);

        return view('frontend.reset_password');
    }

    function update_password(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'password'   => 'required|min:6',
            'cpassword'  => 'required|same:password',
            'email'      => 'required|email',
            'user_id'    => 'required|integer',
            'auth_id'    => 'required|string'
        ]);

        if ($validator->fails()) {
        return redirect('reset_password/' . $req->auth_id)
            ->withErrors($validator)
            ->withInput();
    }

        // Verify user exists
        $user = DB::table('users')
            ->where('email_id', $req->email)
            ->where('id', $req->user_id)
            ->first();

        if (!$user) {
            return redirect('reset_password/' . $req->auth_id)->with('error', 'User not found.');
        }

        // Update password
        DB::table('users')
            ->where('id', $req->user_id)
            ->update(['password' => Hash::make($req->password)]);

        // Mark reset token as used (if `is_verified` column exists)
        // DB::table('password_resets')
        //     ->where('token', $req->auth_id)
        //     ->update(['is_verified' => 1]);

        return redirect('/login')->with('status', 'Password updated successfully. Please log in.');
    }



    public function logout()
    {
        session()->flush();
        return redirect('/');
    }

    function forgot()
    {
        return view('frontend.forgot');
    }

    public function TestView()
    {
        return view('frontend.test');
    }

    public function ContactView()
    {
        return view('frontend.contact');
    }

    public function RegisterView()
    {
        return view('registration');
    }

    public function ServicesView()
    {
        return view('frontend.services');
    }
    public function AboutView()
    {
        return view('frontend.about');
    }
    public function PrivacyView()
    {
        return view('frontend.privacy');
    }
    public function TermCondView()
    {
        return view('frontend.termcond');
    }

    public function PropDetailsView($slugAndId){
        // Separate the slug and ID from the URL segment
        $parts = explode('-', $slugAndId);
        $id = array_pop($parts); // Extract the ID (last part)
        $slug = implode('-', $parts); // Reconstruct the slug

        // Fetch property based on both ID and slug (optional but safer)
        $propertyDetails = DB::table('properties')
            ->where('properties_id', $id)
            ->where('slug', $slug)
            ->first();

        if (!$propertyDetails) {
            abort(404);
        }

        // Get full property details
        $data['propertie_details'] = DB::select(
            'SELECT * FROM properties AS p, price_range AS pr, property_category AS pc 
            WHERE p.price_range_id = pr.range_id 
            AND pc.pid = p.property_type_id 
            AND p.properties_id = ?', [$id]
        );

        // Get additional images
        $data['additional_images'] = DB::table('property_images')
            ->where('properties_id', $propertyDetails->properties_id)
            ->get();

        // Get FAQs related to the property
        $data['faqs'] = DB::table('faqs')
            ->where('property_id', $propertyDetails->properties_id)
            ->get();

        // Return view with meta data
        return view('dhara-jfin.prop-details', compact('data'))
        ->with([
            'faqs' => $data['faqs'],
            'meta_title' => $propertyDetails->meta_title ?? 'Default Property Title',
            'meta_description' => $propertyDetails->meta_description ?? 'Default Property Description',
            'meta_keywords' => $propertyDetails->meta_keywords ?? 'Default Keywords',
            'schema_markup' => $propertyDetails->schema_markup ?? '',
        ]);
    }
    // public function PropDetailsView($property_id)
    // {
    //     $data['propertie_details'] = DB::select('select * from properties as p, price_range as pr, property_category as pc where 
    //     p.price_range_id = pr.range_id and pc.pid = p.property_type_id and p.properties_id =' . $property_id);
    //     $data['additional_images'] = DB::table('property_images')
    //         ->where('properties_id', $property_id)
    //         ->get();

    //     return view('frontend.property-details-test', compact('data'));
    // }

    // Loan Application
    public function ProfessionalDetailView()
    {
        return view('frontend.professional-info');
    }

    public function CalculatorView()
    {
        return view('frontend.calculator');
    }

//    public function properties()
//     {
//         $data['allProperties'] = DB::table('properties')
//             ->join('price_range', 'properties.price_range_id', '=', 'price_range.range_id')
//             ->join('property_category', 'properties.property_type_id', '=', 'property_category.pid')
//             ->where('properties.is_active', 1)
//             ->select(
//                 'properties.properties_id', 'properties.slug', 'properties.title', 'properties.property_type_id', 
//                 'properties.builder_name', 'properties.select_bhk', 'properties.address', 
//                 'properties.facilities', 'properties.beds', 'properties.baths', 'properties.balconies', 
//                 'properties.parking', 'properties.contact', 'price_range.from_price', 'price_range.to_price', 
//                 'property_category.category_name', 'properties.property_details', 
//                 'properties.localities', 'properties.city', 'properties.area',
//                 'properties.is_featured', 'properties.s_price'
//             )
//             ->paginate(700);
    
//         $data['category'] = DB::table('property_category')->get();
//         $data['range'] = DB::table('price_range')->get();
    
//         // Fetch first image for each property
//         $propertyImages = DB::table('property_images')
//             ->select('properties_id', 'image_url')
//             ->whereIn('properties_id', $data['allProperties']->pluck('properties_id'))
//             ->orderBy('is_featured', 'DESC') 
//             ->get()
//             ->groupBy('properties_id');
    
//         // Attach images to properties
//         foreach ($data['allProperties'] as $property) {
//             $property->image = isset($propertyImages[$property->properties_id]) 
//                 ? $propertyImages[$property->properties_id]->first()->image_url 
//                 : 'default.jpg';
//         }
    
//         // Fetch **Featured Properties**
//         $data['featuredProperties'] = DB::table('properties')
//             ->join('price_range', 'properties.price_range_id', '=', 'price_range.range_id')
//             ->join('property_category', 'properties.property_type_id', '=', 'property_category.pid')
//             ->where('properties.is_featured', 1)
//             ->where('properties.is_active', 1)
//             ->select(
//                 'properties.properties_id', 'properties.slug', 'properties.title', 'properties.address', 'properties.builder_name',
//                 'properties.s_price', 'properties.is_featured', 'properties.localities', 'properties.city',
//                 'property_category.category_name', 'price_range.from_price', 'properties.select_bhk', 'properties.area','price_range.from_price', 'price_range.to_price'
//             )
//             ->get();
    
//             // Attach images to **Featured Properties**
//             foreach ($data['featuredProperties'] as $featured) {
//                 $featured->image = isset($propertyImages[$featured->properties_id]) 
//                     ? $propertyImages[$featured->properties_id]->first()->image_url 
//                     : 'default.jpg';
//             }
        
//             // **Existing Localities Data with Property Count**
//             $data['localities'] = DB::table('properties')
//                 ->select('localities', 'city', \DB::raw('COUNT(*) as property_count'), \DB::raw('MAX(image) as image'))
//                 ->groupBy('localities', 'city')
//                 ->get();
        
//             // **Fetch Three Selected Localities**
//             $selectedLocalities = DB::table('selected_localities')
//             ->join('localities', 'selected_localities.locality_id', '=', 'localities.id')
//             ->select('localities.id', 'localities.name')
//             ->limit(3)
//             ->get();
            
          
//             // Fetch **Properties for Each Selected Locality (First 2 Properties)**
//             $data['selectedLocalities'] = [];
//                 foreach ($selectedLocalities as $locality) {
//                     $properties = DB::table('properties')
//                         ->where('localities', 'LIKE', "%{$locality->name}%")
//                         ->where('is_active', 1)
//                         ->select('properties_id', 'title', 'builder_name', 'slug') // Remove 'image' from selection
//                         ->limit(2)
//                         ->get();

//                     // Attach images from property_images table
//                     $propertyImages = DB::table('property_images')
//                         ->whereIn('properties_id', $properties->pluck('properties_id'))
//                         ->select('properties_id', 'image_url')
//                         ->orderBy('is_featured', 'DESC') 
//                         ->get()
//                         ->groupBy('properties_id');

//                     foreach ($properties as $property) {
//                          $property->image = isset($propertyImages[$property->properties_id])
//                             ? env('baseURL') . "/" . $propertyImages[$property->properties_id]->first()->image_url
//                             : env('baseURL') . "/theme/frontend/img/default.jpg"; // Use default if no image
//                     }

//                     $data['selectedLocalities'][] = [
//                         'locality' => $locality->name,
//                         'properties' => $properties
//                     ];
//                 }
//         return view('dhara-jfin.properties', compact('data'));
//     }


public function properties(Request $request)
{
    /* ================= MAIN QUERY ================= */

    $query = DB::table('properties')
        ->join('price_range', 'properties.price_range_id', '=', 'price_range.range_id')
        ->join('property_category', 'properties.property_type_id', '=', 'property_category.pid')
        ->where('properties.is_active', 1)
        ->select(
            'properties.properties_id',
            'properties.slug',
            'properties.title',
            'properties.property_type_id',
            'properties.builder_name',
            'properties.select_bhk',
            'properties.address',
            'properties.facilities',
            'properties.beds',
            'properties.baths',
            'properties.balconies',
            'properties.parking',
            'properties.contact',
            'price_range.from_price',
            'price_range.to_price',
            'property_category.category_name',
            'properties.property_details',
            'properties.localities',
            'properties.city',
            'properties.area',
            'properties.is_featured',
            'properties.s_price'
        );

    /* ================= SEARCH ================= */

    if ($request->filled('search')) {
        $search = trim($request->search);

        $query->where(function ($q) use ($search) {
            $q->where('properties.title', 'LIKE', "%{$search}%")
              ->orWhere('properties.builder_name', 'LIKE', "%{$search}%")
              ->orWhere('properties.localities', 'LIKE', "%{$search}%")
              ->orWhere('properties.city', 'LIKE', "%{$search}%");
        });
    }

    /* ================= BHK FILTER ================= */

    if ($request->filled('bhk')) {
        $query->where('properties.select_bhk', $request->bhk);
    }

    /* ================= BUDGET FILTER ================= */

    if ($request->filled('budget')) {

        switch ($request->budget) {

            case '40-60':
                $query->whereBetween('properties.s_price', [4000000, 6000000]);
                break;

            case '60-80':
                $query->whereBetween('properties.s_price', [6000000, 8000000]);
                break;

            case '80-100':
                $query->whereBetween('properties.s_price', [8000000, 10000000]);
                break;

            case '100-200':
                $query->whereBetween('properties.s_price', [10000000, 20000000]);
                break;

            case '200+':
                $query->where('properties.s_price', '>=', 20000000);
                break;
        }
    }

    /* ================= PAGINATION ================= */

    $data['allProperties'] = $query->paginate(12)->appends($request->all());

    /* ================= CATEGORY ================= */

    $data['category'] = DB::table('property_category')->get();

    /* ================= IMAGES (FOR MAIN LIST) ================= */

    $propertyImages = DB::table('property_images')
        ->whereIn('properties_id', $data['allProperties']->pluck('properties_id'))
        ->select('properties_id','image_url')
        ->orderBy('is_featured','DESC')
        ->get()
        ->groupBy('properties_id');

    foreach ($data['allProperties'] as $property) {
        $property->image = isset($propertyImages[$property->properties_id])
            ? $propertyImages[$property->properties_id]->first()->image_url
            : 'default.jpg';
    }

    /* ================= FEATURED PROPERTIES ================= */

    if (!$request->filled('search') &&
        !$request->filled('bhk') &&
        !$request->filled('budget')) {

        $data['featuredProperties'] = DB::table('properties')
            ->where('is_featured',1)
            ->where('is_active',1)
            ->select(
                'properties_id',
                'slug',
                'title',
                'builder_name',
                's_price',
                'localities',
                'city',
                'select_bhk',
                'area'
            )
            ->get();

        // Attach images
        $featuredImages = DB::table('property_images')
            ->whereIn('properties_id', $data['featuredProperties']->pluck('properties_id'))
            ->select('properties_id','image_url')
            ->orderBy('is_featured','DESC')
            ->get()
            ->groupBy('properties_id');

        foreach ($data['featuredProperties'] as $property) {
            $property->image = isset($featuredImages[$property->properties_id])
                ? $featuredImages[$property->properties_id]->first()->image_url
                : 'default.jpg';
        }

    } else {
        $data['featuredProperties'] = collect();
    }

    /* ================= SELECTED LOCALITIES ================= */

    if (!$request->filled('search')) {

        $selectedLocalities = DB::table('selected_localities')
            ->join('localities','selected_localities.locality_id','=','localities.id')
            ->select('localities.id','localities.name')
            ->limit(3)
            ->get();

        $data['selectedLocalities'] = [];

        foreach ($selectedLocalities as $locality) {

            $properties = DB::table('properties')
                ->where('localities','LIKE',"%{$locality->name}%")
                ->where('is_active',1)
                ->select('properties_id','title','builder_name','slug')
                ->limit(2)
                ->get();

            // Attach images
            $localImages = DB::table('property_images')
                ->whereIn('properties_id', $properties->pluck('properties_id'))
                ->select('properties_id','image_url')
                ->orderBy('is_featured','DESC')
                ->get()
                ->groupBy('properties_id');

            foreach ($properties as $property) {
                $property->image = isset($localImages[$property->properties_id])
                    ? $localImages[$property->properties_id]->first()->image_url
                    : 'default.jpg';
            }

            $data['selectedLocalities'][] = [
                'locality' => $locality->name,
                'properties' => $properties
            ];
        }

    } else {
        $data['selectedLocalities'] = [];
    }

    return view('dhara-jfin.properties', compact('data'));
}


    public function search_properties(Request $request)
    {
        $range_id = $request->range_id;
        $category_type = $request->category_type;
        $location_name = $request->location_name;
        $property_type_id = $request->property_type_id; // Get from AJAX request

        // Start building the query
        $query = DB::table('properties')
            ->join('price_range', 'properties.price_range_id', '=', 'price_range.range_id')
            ->join('property_category', 'properties.property_type_id', '=', 'property_category.pid')
            ->where('properties.is_active', 1);

        // Filter by property type (Buy = 1, Commercial = 2, Rent = 3)
        if (!empty($property_type_id)) {
            $query->where('properties.property_type_id', $property_type_id);
        }

        // Apply additional filters if selected
        if (!empty($category_type)) {
            $query->where('properties.property_type_id', $category_type);
        }

        if (!empty($range_id)) {
            $query->where('properties.price_range_id', $range_id);
        }

        if (!empty($location_name)) {
            $query->where('properties.localities', 'LIKE', "%{$location_name}%");
        }

        // Select the required columns
        $data['allProperties'] = $query->select(
            'properties.properties_id',
            'properties.title',
            'properties.image',
            'properties.property_type_id',
            'properties.builder_name',
            'properties.select_bhk',
            'properties.address',
            'properties.facilities',
            'properties.contact',
            'price_range.from_price',
            'price_range.to_price',
            'property_category.category_name',
            'properties.property_details'
        )->paginate(700);

        // Get category & price range data for filters
        $data['category'] = DB::table('property_category')->get();
        $data['range'] = DB::table('price_range')->get();

        // Return the results dynamically for AJAX
        return view('frontend.searchResult', compact('data'))->render();
    }

    public function ReferralsView()
    {
        return view('frontend.referrals');
    }

    public function HomeLoanView()
    {
        return view('frontend.allLoans.home');
    }

    public function LAPLoanView()
    {
        return view('frontend.allLoans.loan-against-property');
    }

    public function ProjectLoanView()
    {
        return view('frontend.allLoans.project');
    }

    public function OverdraftLoanView()
    {
        return view('frontend.allLoans.overdraft-facility');
    }

    public function LRDLoanView()
    {
        return view('frontend.allLoans.lrd');
    }

    public function MSMELoanView()
    {
        return view('frontend.allLoans.msme');
    }
}
