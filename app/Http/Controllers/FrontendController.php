<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use App\Models\PasswordResets;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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

        $validator = Validator::make($request->all(), ['email' => 'required',]);

        if (!$validator->passes()) {
            return redirect('forgot')->with('error', 'The Email Address field is empty.');
        } else {
            $user = DB::table('users')
                ->where('email_id', $request->email)
                ->first();
            if ($user) {

                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
                $auth_id = substr(str_shuffle($permitted_chars), 0, 10);
                $expFormat = mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y"));
                $expDate = date("Y-m-d H:i:s", $expFormat);

                $email = $request->email;
                $name = $user->name;
                $msg = env('baseURL') . "/reset_password/" . $auth_id;
                $temp_id = 2;

                $values = [
                    'email' => $email,
                    'token' => $auth_id,
                    'exp_date' => $expDate,
                    'user_id' => $user->id
                ];

                // die;
                $addExp = PasswordResets::create($values);

                //calling UsersController temail function from FrontendController
                app(UsersController::class)->temail($email, $name, $msg, $temp_id);

                return redirect('forgot')->with('status', 'We sent an email to your registered email-id to help you recover your account. Please login into your email account and click on the link we sent to reset your password');
            } else {
                return redirect('forgot')->with('error', 'Sorry, no user exists on our system with that email');
            }
        }
    }


    function reset_password($auth_id)
    {
        $curDate = date("Y-m-d H:i:s");
        $user = DB::table('password_resets')->where('token', $auth_id)->first();
        if ($user) {
            if ($user->exp_date >= $curDate) {
                if ($user->is_verified == 1) {
                    return redirect('forgot')->with('error', 'The link is expired. You have already used this link to reset your password. Please enter Email ID again to generate to reset link.');
                } else {
                    session()->put('email_id', $user->email);
                    session()->put('user_id', $user->user_id);
                    session()->put('auth_id', $auth_id);
                    return view('frontend.reset_password');
                }
            } else {
                return redirect('forgot')->with('error', 'The link is expired. You are trying to use the expired link which as valid only 24 hours (1 days after request).');
            }
        } else {
            return redirect('forgot')->with('error', 'Authentication failed!');
        }
    }

    function update_password(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'password' => 'required',
        ]);

        if (!$validator->passes()) {
            return redirect('reset_password/' . $req->auth_id)->with('error', 'The Password field is empty.');
        } else {
            $first_password = $req->input('password');
            $second_password = $req->input('cpassword');
            $email = $req->input('email');
            $user_id = $req->input('user_id');

            $check = strcmp($first_password, $second_password);
            if ($check == 0) {
                // $pwd = Hash::make($second_password);
                $users = DB::table('users')->where('email_id', $email)->where('id', $user_id)->first();
                if ($users) {
                    DB::table('users')->where('email_id', $email)->where('id', $user_id)->update(['password' => md5($first_password)]);
                    $update = PasswordResets::where('token', $req->auth_id)->update(['is_verified' =>  1]);
                    return redirect('/')->with('status', 'Password updated.');
                }
            } else {
                return redirect('reset_password/' . $req->auth_id)->with('error', 'Password and Confirmed Password do not match');
            }
        }
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

    public function PropDetailsView($property_id)
    {
        $data['propertie_details'] = DB::select('select * from properties as p, price_range as pr, property_category as pc where 
        p.price_range_id = pr.range_id and pc.pid = p.property_type_id and p.properties_id =' . $property_id);
        $data['additional_images'] = DB::table('property_images')
            ->where('properties_id', $property_id)
            ->get();

        return view('frontend.property-details-test', compact('data'));
    }

    // Loan Application
    public function ProfessionalDetailView()
    {
        return view('frontend.professional-info');
    }

    public function CalculatorView()
    {
        return view('frontend.calculator');
    }

    public function properties()
    {
        $data['allProperties'] = DB::table('properties')
            ->join('price_range', 'properties.price_range_id', '=', 'price_range.range_id')
            ->join('property_category', 'properties.property_type_id', '=', 'property_category.pid')
            ->where('properties.is_active', 1)
            ->select(
                'properties.properties_id',
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
                'properties.area'
            )
            ->paginate(700);

        $data['category'] = DB::table('property_category')->get();
        $data['range'] = DB::table('price_range')->get();

        // Fetch first image for each property from property_images
        $propertyImages = DB::table('property_images')
            ->select('properties_id', 'image_url')
            ->whereIn('properties_id', $data['allProperties']->pluck('properties_id')) // Fetch images only for listed properties
            ->orderBy('is_featured', 'DESC') // Prefer featured images
            ->get()
            ->groupBy('properties_id');

        // Attach image to each property
        foreach ($data['allProperties'] as $property) {
            $property->image = isset($propertyImages[$property->properties_id])
                ? $propertyImages[$property->properties_id]->first()->image_url
                : 'default.jpg'; // Fallback image
        }

        return view('frontend.properties', compact('data'));
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
