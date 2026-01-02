<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserAuthController extends Controller
{
    /**
     * REGISTER USER
     * POST /api/register
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email_id' => 'required|email|unique:users,email_id',
            'password' => 'required|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = UserAccount::create([
            'name' => $request->name,
            'email_id' => $request->email_id,
            'password' => Hash::make($request->password),
            'role_id' => 1,
            'is_email_verify' => 1
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User registered successfully',
            'user_id' => $user->id
        ], 201);
    }

    /**
     * LOGIN USER
     * POST /api/login
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_id' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = UserAccount::where('email_id', $request->email_id)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid email or password'
            ], 401);
        }

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'user' => $user
        ]);
    }

    /**
     * ADD USER (PUT)
     * PUT /api/user/add
     */
    public function addUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email_id' => 'required|email|unique:users,email_id',
            'password' => 'required|min:6',
            'mobile_no' => 'required|digits:10'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = UserAccount::create([
            'name' => $request->name,
            'email_id' => $request->email_id,
            'mobile_no' => $request->mobile_no,
            'password' => Hash::make($request->password),
            'role_id' => 1,
            'is_email_verify' => 1
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User added successfully',
            'user_id' => $user->id
        ], 201);
    }
}
