<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Show logged-in user's profile
     */
//     public function showProfile()
//     {
//        $userId = session()->get('user_id');

// if (!$userId) {
//     return redirect()->route('login')->with('error', 'Session expired. Please login again.');
// }

//         // ✅ Join cities & states for readable names
//         $user = DB::table('users')->where('id', $userId)->first();

//         $profile = DB::table('profile')
//     ->leftJoin('cities', 'profile.city', '=', 'cities.id')
//     ->leftJoin('states', 'profile.state', '=', 'states.id')
//     ->select('profile.*', 'cities.city as city_name', 'states.name as state_name')
//     ->where('profile.user_id', $userId)
//     ->first();

//        if ($user) {
//             return view('admin.profile', compact('user', 'profile'));
//         }

//         return redirect('/')->with('error', 'User or profile information not found.');
//     }

    /**
     * Show edit form
     */

    public function showProfile()
{
    $userId = session()->get('user_id');

    if (!$userId) {
        return redirect()->route('login')->with('error', 'Session expired. Please login again.');
    }

    // Get user
    $user = DB::table('users')->where('id', $userId)->first();

    if (!$user) {
        return redirect('/')->with('error', 'User not found.');
    }

    // Get profile
    $profile = DB::table('profile')
        ->leftJoin('cities', 'profile.city', '=', 'cities.id')
        ->leftJoin('states', 'profile.state', '=', 'states.id')
        ->select('profile.*', 'cities.city as city_name', 'states.name as state_name')
        ->where('profile.user_id', $userId)
        ->first();

    // ✅ Auto create profile if not exists
    if (!$profile) {
        DB::table('profile')->insert([
            'user_id' => $userId,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // fetch again
        $profile = DB::table('profile')
            ->leftJoin('cities', 'profile.city', '=', 'cities.id')
            ->leftJoin('states', 'profile.state', '=', 'states.id')
            ->select('profile.*', 'cities.city as city_name', 'states.name as state_name')
            ->where('profile.user_id', $userId)
            ->first();
    }

    return view('admin.profile', compact('user', 'profile'));
}
    public function editProfile()
    {
       $userId = session()->get('user_id');

if (!$userId) {
    return redirect()->route('login')->with('error', 'Session expired. Please login again.');
}
        $user = DB::table('users')->where('id', $userId)->first();
        $profile = DB::table('profile')->where('user_id', $userId)->first();
if ($user) {
            return view('admin.profile-edit', compact('user', 'profile'));
        }

        return redirect('/')->with('error', 'User or profile information not found.');
    }

    /**
     * Update user profile
     */
   public function updateProfile(Request $request)
{
    $userId = session()->get('user_id');

if (!$userId) {
    return redirect()->route('login')->with('error', 'Session expired. Please login again.');
}

    // ✅ Validation rules
    $request->validate([
    'name' => ['required', 'regex:/^[A-Za-z\s]+$/'], // ✅ फक्त अक्षरे आणि spaces allowed
    'email_id' => 'nullable|string|email|max:255',
    'dob' => 'nullable|date',
    'mobile_no' => 'nullable|string|max:20',
    'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    'gender' => 'nullable|string|max:255',
], [
    'name.regex' => 'Numbers are not allowed. Please enter only characters.',
]);

    // ✅ Update `users` table
    DB::table('users')->where('id', $userId)->update([
        'name' => $request->input('name'),
        'email_id' => $request->input('email_id'),
    ]);

    // ✅ Update profile info
    $profileData = [
        'dob' => $request->input('dob'),
        'mobile_no' => $request->input('mobile_no'),
        'gender' => $request->input('gender'),
    ];

    // ✅ Handle avatar upload
    if ($request->hasFile('avatar')) {
        $existing = DB::table('profile')->where('user_id', $userId)->first();
        if ($existing && $existing->avatar) {
            Storage::delete('public/avatars/' . $existing->avatar);
        }

        $avatarPath = $request->file('avatar')->store('avatars', 'public');
        $profileData['avatar'] = basename($avatarPath);
    }

    DB::table('profile')->where('user_id', $userId)->update($profileData);

    return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
}


    /**
     * Channel Partner Profile View
     */
    public function showPartnerProfile()
    {
        $userId = session('user_id');

        // ✅ Join city/state names for display
        $profile = DB::table('users')
            ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
            ->leftJoin('cities', 'profile.city', '=', 'cities.id')
            ->leftJoin('states', 'profile.state', '=', 'states.id')
            ->select(
                'users.name',
                'users.email_id',
                'profile.mobile_no',
                'profile.dob',
                'profile.marital_status',
                'profile.gender',
                'profile.avatar',
                'profile.residence_address',
                'cities.name as city_name',
                'states.name as state_name',
                'profile.pincode',
                'profile.rera_doc',
                'profile.licence_doc',
                'profile.address_proof'
            )
            ->where('users.id', $userId)
            ->first();

        return view('profile.partnerProfile', compact('profile'));
    }

    /**
     * Channel Partner Profile Update
     */
    public function updatePartnerProfile(Request $request)
    {
        $userId = session('user_id');
        Log::info('Updating Partner Profile for user ID: ' . $userId, $request->all());

        $request->validate([
            'mobile_no' => 'nullable|digits:10',
            'dob' => 'nullable|date',
            'marital_status' => 'nullable|string',
            'gender' => 'nullable|string',
            'residence_address' => 'nullable|string',
            'city' => 'nullable|integer',
            'state' => 'nullable|integer',
            'rera_doc' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'licence_doc' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'address_proof' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // ✅ File uploads
        $files = [
            'rera_doc' => $request->file('rera_doc'),
            'licence_doc' => $request->file('licence_doc'),
            'address_proof' => $request->file('address_proof'),
        ];

        $paths = [];
        foreach ($files as $key => $file) {
            if ($file) {
                $paths[$key] = $file->store('uploads', 'public');
            }
        }

        Log::info('Uploaded file paths:', $paths);

        // ✅ Update profile
        $updated = DB::table('profile')->updateOrInsert(
            ['user_id' => $userId],
            [
                'mobile_no' => $request->mobile_no,
                'dob' => $request->dob,
                'marital_status' => $request->marital_status,
                'gender' => $request->gender,
                'residence_address' => $request->residence_address,
                'city' => $request->city,
                'state' => $request->state,
                'rera_doc' => $paths['rera_doc'] ?? DB::raw('rera_doc'),
                'licence_doc' => $paths['licence_doc'] ?? DB::raw('licence_doc'),
                'address_proof' => $paths['address_proof'] ?? DB::raw('address_proof'),
                'updated_at' => now(),
            ]
        );

        Log::info('Profile updated successfully.', ['result' => $updated]);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
