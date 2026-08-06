<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AdminLeadReferralController extends Controller
{
    /**
     * Dashboard
     */
public function index(Request $request)
{
    // Total Lead Referral Users
    $totalLeadReferral = DB::table('users')
        ->where('role_id', 7)
        ->whereNull('deleted_at')
        ->count();

    // Today's Lead Referrals
    $todayLeadReferral = DB::table('users')
        ->where('role_id', 7)
        ->whereNull('deleted_at')
        ->whereDate('created_at', today())
        ->count();

    // Total Leads
    $totalLead = DB::table('lead_referral')->count();

$closedLead = DB::table('lead_referral')
    ->where('status','Closed')
    ->count();

    // Closed Leads
    $closedLead = DB::table('referral_leads')
        ->where('status', 'Closed')
        ->count();

    // States
    $states = DB::table('states')
        ->orderBy('name')
        ->get();

    return view('admin.lead-referral.index', compact(
        'totalLeadReferral',
        'todayLeadReferral',
        'totalLead',
        'closedLead',
        'states'
    ));
}

    /**
     * Load Lead Referral List
     */
public function loadList(Request $request)
{
    try {

        $type = $request->type;

        // ===========================
        // Total Leads / Closed Leads
        // ===========================
        if ($type == 'total_leads' || $type == 'closed_leads') {

            $query = DB::table('lead_referral')
                ->leftJoin('states', 'lead_referral.state_id', '=', 'states.id')
                ->leftJoin('cities', 'lead_referral.city_id', '=', 'cities.id');

            if ($type == 'closed_leads') {
                $query->where('lead_referral.status', 'Closed');
            }

            if ($request->search) {

                $query->where(function ($q) use ($request) {

                    $q->where('customer_name', 'like', '%' . $request->search . '%')
                      ->orWhere('mobile_no', 'like', '%' . $request->search . '%')
                      ->orWhere('email', 'like', '%' . $request->search . '%')
                      ->orWhere('loan_type', 'like', '%' . $request->search . '%');

                });

            }

            $leadReferrals = $query->select(
                'lead_referral.*',
                'states.name as state_name',
                'cities.city as city_name'
            )
            ->orderBy('lead_referral.id', 'DESC')
            ->get();

            $html = view(
                'admin.lead-referral.partials.lead-list',
                compact('leadReferrals')
            )->render();

            return response()->json([
                'html' => $html
            ]);
        }

        // ===========================
        // Lead Referral Users
        // ===========================

        $query = DB::table('users')
            ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
            ->leftJoin('cities', 'profile.city', '=', 'cities.id')
            ->leftJoin('states', 'profile.state', '=', 'states.id')
            ->where('users.role_id', 7)
            ->whereNull('users.deleted_at');

        if ($type == 'today') {
            $query->whereDate('users.created_at', today());
        }

        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where('users.name', 'like', '%' . $request->search . '%')
                  ->orWhere('users.email_id', 'like', '%' . $request->search . '%')
                  ->orWhere('users.mobile_no', 'like', '%' . $request->search . '%')
                  ->orWhere('users.referral_code', 'like', '%' . $request->search . '%');

            });

        }

        $leadReferrals = $query->select(
            'users.id',
            'users.name',
             'users.status',
            'users.email_id',
            DB::raw('COALESCE(profile.mobile_no, users.mobile_no) as mobile_no'),
            'users.referral_code',
            'profile.pan_number',
            'profile.pincode',
            'cities.city as city_name',
            'states.name as state_name'
        )
        ->orderBy('users.id', 'DESC')
        ->get();

        $html = view(
            'admin.lead-referral.partials.list',
            compact('leadReferrals')
        )->render();

        return response()->json([
            'html' => $html
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'html' => '<tr><td colspan="20">' . $e->getMessage() . '</td></tr>'
        ]);

    }
}

public function changeStatus(Request $request)
{
    DB::table('users')
        ->where('id', $request->id)
        ->update([
            'status' => $request->status,
            'updated_at' => now(),
        ]);

    return response()->json([
        'status' => 1,
        'message' => 'Status Updated Successfully'
    ]);
}

public function edit($id)
{
    $user = DB::table('users')
        ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->select(
            'users.id',
            'users.name',
            'users.email_id',
            'users.mobile_no',
            'users.referral_code',
            'profile.pan_number',
            'profile.residence_address',
            'profile.state',
            'profile.city',
            'profile.pincode',
            'profile.dob'
        )
        ->where('users.id', $id)
        ->where('users.role_id', 7)
        ->first();

    if (!$user) {
        abort(404);
    }

    $states = DB::table('states')->orderBy('name')->get();

    $cities = DB::table('cities')
        ->where('state_id', $user->state)
        ->orderBy('city')
        ->get();

    return view('admin.lead-referral.edit', compact(
        'user',
        'states',
        'cities'
    ));
}

public function update(Request $request, $id)
{
    DB::table('users')
        ->where('id', $id)
        ->update([
            'name' => $request->name,
            'email_id' => $request->email_id,
            'mobile_no' => $request->mobile_no,
            'updated_at' => now()
        ]);

    DB::table('profile')
        ->updateOrInsert(
            ['user_id' => $id],
            [
                'pan_number' => $request->pan_number,
                'pincode' => $request->pincode,
                'updated_at' => now()
            ]
        );

    return redirect()->route('admin.lead-referral.index')
        ->with('success','Updated Successfully');
}
    public function getCity(Request $request)
    {
        return DB::table('cities')
            ->where('state_id', $request->state_id)
            ->select('id', 'city')
            ->orderBy('city')
            ->get();
    }

    /**
     * Edit Lead Referral
     */
   

    /**
     * Store
     */
   public function store(Request $request)
{
    DB::beginTransaction();

    try {

        // ================= VALIDATION =================

        if ($request->id) {

            // UPDATE

            $request->validate([
                'full_name' => 'required',
                'email_id' => [
                    'required',
                    'email',
                    'regex:/^[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com)$/',
                    'unique:users,email_id,' . $request->id
                ],
                'mobile_no' => 'required|digits:10|unique:users,mobile_no,' . $request->id,
                'pan_no' => [
                    'required',
                    'regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
                    'unique:profile,pan_number,' . $request->id . ',user_id'
                ],
                'pincode' => 'required|digits:6',
                'dob' => 'required|before:18 years ago'
            ]);

        } else {

            // INSERT

            $request->validate([
                'full_name' => 'required',
                'email_id' => [
                    'required',
                    'email',
                    'regex:/^[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com)$/',
                    'unique:users,email_id'
                ],
                'mobile_no' => 'required|digits:10|unique:users,mobile_no',
                'pan_no' => [
                    'required',
                    'regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
                    'unique:profile,pan_number'
                ],
                'pincode' => 'required|digits:6',
                'dob' => 'required|before:18 years ago',
                'password' => 'required|min:6'
            ]);

        }

        // ================= UPDATE =================

        if ($request->id) {

            $updateData = [
                'name' => $request->full_name,
                'email_id' => $request->email_id,
                'mobile_no' => $request->mobile_no,
                'updated_at' => now()
            ];

            if (!empty($request->password)) {
                $updateData['password'] = bcrypt($request->password);
            }

            DB::table('users')
                ->where('id', $request->id)
                ->update($updateData);

            DB::table('profile')
                ->where('user_id', $request->id)
                ->update([
                    'pan_number' => $request->pan_no,
                    'residence_address' => $request->address,
                    'dob' => $request->dob,
                    'city' => $request->city,
                    'state' => $request->state,
                    'pincode' => $request->pincode,
                    'updated_at' => now()
                ]);

        } else {

            // ================= INSERT =================

            $userId = DB::table('users')->insertGetId([
                'name' => $request->full_name,
                'email_id' => $request->email_id,
                'mobile_no' => $request->mobile_no,
                'password' => bcrypt($request->password),
                'role_id' => 7,
                'is_email_verify' => 1,
                'created_at' => now()
            ]);

            // Generate Referral Code
            $referralCode = 'LR' . str_pad($userId, 4, '0', STR_PAD_LEFT);

            DB::table('users')
                ->where('id', $userId)
                ->update([
                    'referral_code' => $referralCode
                ]);

            DB::table('profile')->insert([
                'user_id' => $userId,
                'pan_number' => $request->pan_no,
                'residence_address' => $request->address,
                'dob' => $request->dob,
                'city' => $request->city,
                'state' => $request->state,
                'pincode' => $request->pincode,
                'created_at' => now()
            ]);

        }

        DB::commit();

        return response()->json([
            'status' => 1,
            'message' => $request->id
                ? 'Lead Referral updated successfully.'
                : 'Lead Referral added successfully.'
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {

        DB::rollback();

        throw $e;

    } catch (\Exception $e) {

        DB::rollback();

        return response()->json([
            'status' => 0,
            'message' => $e->getMessage()
        ]);

    }
}

    public function destroy($id)
{
    DB::table('profile')
        ->where('user_id', $id)
        ->delete();

    DB::table('users')
        ->where('id', $id)
        ->delete();

    return response()->json([
        'status' => 1,
        'message' => 'Lead Referral deleted successfully.'
    ]);
}
}