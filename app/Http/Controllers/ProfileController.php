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
     * Display the user's profile form.
     */
    public function showProfile()
{
    $userId = session('user_id'); // Ensure session ID is correctly retrieved

    if ($userId) {
        // Fetch user information
        $user = DB::table('users')->where('id', $userId)->first();
        // Fetch additional profile information
        $profile = DB::table('profile')->where('user_id', $userId)->first();

        if ($user && $profile) {
            // Pass both user and profile data to the view
            return view('admin.profile', compact('user', 'profile'));
        } else {
            // Redirect back with an error message if either user or profile data is missing
            return redirect('/')->with('error', 'User or profile information not found.');
        }
    } else {
        // Redirect back with an error message if the session is missing the user ID
        return redirect('/')->with('error', 'No user ID in session.');
    }
}


    /**
     * Display the profile edit form.
     */
    public function editProfile()
    {
        $userId = session('user_id');

        if ($userId) {
            $user = DB::table('users')->where('id', $userId)->first();
            $profile = DB::table('profile')->where('user_id', $userId)->first();

            if ($user && $profile) {
                return view('admin.profile-edit', compact('user', 'profile'));
            } else {
                return redirect('/')->with('error', 'User or profile information not found.');
            }
        } else {
            return redirect('/')->with('error', 'No user ID in session.');
        }
    }

    /**
     * Update the profile information.
     */
    public function updateProfile(Request $request)
    {
        $userId = session()->get('user_id');
        if ($userId) {
            // Validate the input
            $request->validate([
                'name' => 'string|max:255',
                'email_id' => 'string|email|max:255',
                'dob' => 'date',
                'mobile_no' => 'string|max:20',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'gender' => 'string|max:255',
            ]);

        // Update user information
        DB::table('users')->where('id', $userId)->update([
            'name' => $request->input('name'),
            'email_id' => $request->input('email_id'),
        ]);

            // Prepare update data for profile
            $profileData = [
                'dob' => $request->input('dob'),
                'mobile_no' => $request->input('mobile_no'),
                'gender' => $request->input('gender'),
            ];

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $existingProfile = DB::table('profile')->where('user_id', $userId)->first();
            
            // Delete old avatar if exists
            if ($existingProfile && $existingProfile->avatar) {
                Storage::delete('public/avatars/' . $existingProfile->avatar);
            }

            // Store new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $profileData['avatar'] = basename($avatarPath);
        }

        // Update profile information
        $updateProfile = DB::table('profile')->where('user_id', $userId)->update($profileData);

        if ($updateProfile !== false) {
            return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
        } else {
            return redirect()->route('admin.profile')->with('error', 'Failed to update profile.');
        }
    } else {
        return redirect()->route('login')->with('error', 'You need to login first.');
    }
}
        // Channel Partner
        public function showPartnerProfile()
        {
            $userId = session()->get('user_id'); // Assuming the logged-in user ID is stored in the session
        
            // Fetch data from both `users` and `profile` tables
            $profile = DB::table('users')
                ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
                ->select(
                    'users.name',
                    'users.email_id',
                    'profile.mobile_no',
                    'profile.dob',
                    'profile.marital_status',
                    'profile.gender',
                    'profile.avatar',
                    'profile.residence_address',
                    'profile.city',
                    'profile.state',
                    'profile.pincode',
                    'profile.rera_doc',
                    'profile.licence_doc',
                    'profile.address_proof'
                )
                ->where('users.id', $userId)
                ->first();
        
            return view('profile.partnerProfile', compact('profile'));
        }

        // Update or create the profile
        public function updatePartnerProfile(Request $request)
        {
            $userId = session()->get('user_id'); // Get logged-in user ID
        
            // Log the received data
            Log::info('Updating profile for user ID: ' . $userId, $request->all());
        
            // Validate input
            $request->validate([
                'mobile_no' => 'nullable|digits:10',
                'dob' => 'nullable|date',
                'marital_status' => 'nullable|string',
                'gender' => 'nullable|string',
                'residence_address' => 'nullable|string',
                'rera_doc' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'licence_doc' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'address_proof' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);
        
            // Handle file uploads
            $reraDocPath = $request->file('rera_doc') ? $request->file('rera_doc')->store('uploads', 'public') : null;
            $licenceDocPath = $request->file('licence_doc') ? $request->file('licence_doc')->store('uploads', 'public') : null;
            $addressProofPath = $request->file('address_proof') ? $request->file('address_proof')->store('uploads', 'public') : null;
        
            // Log file paths to check if files are correctly uploaded
            Log::info('Uploaded file paths:', [
                'rera_doc' => $reraDocPath,
                'licence_doc' => $licenceDocPath,
                'address_proof' => $addressProofPath,
            ]);
        
            // Update or insert into `profile` table
            $updated = DB::table('profile')->updateOrInsert(
                ['user_id' => $userId],
                [
                    'mobile_no' => $request->mobile_no,
                    'dob' => $request->dob,
                    'marital_status' => $request->marital_status,
                    'gender' => $request->gender,
                    'residence_address' => $request->residence_address,
                    'rera_doc' => $reraDocPath ?: DB::raw('rera_doc'),
                    'licence_doc' => $licenceDocPath ?: DB::raw('licence_doc'),
                    'address_proof' => $addressProofPath ?: DB::raw('address_proof'),
                    'updated_at' => now(),
                ]
            );
        
            // Log the result of the update/insert operation
            Log::info('Profile updated or inserted', [
                'updated_rows' => $updated,
            ]);
        
            return redirect()->back()->with('success', 'Profile updated successfully!');
        }
}

