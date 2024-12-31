<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Activity;
use App\Models\UserRelation;
use App\Models\MlmUsers;
use App\Models\Category;
use Illuminate\Support\Facades\Log;



class MlmController extends Controller
{

    public function mlmView(){
        
        $data['categories_items'] = Category::all();
        $data['tree'] = Category::get()->toTree();

        $role_id = env('customerRole');
        $data['users'] = User::where('role_id', $role_id)->get();
        $data['childs'] = Category::descendantsOf(30);

        return view('admin.category', compact('data'));
     
    }    
    public function getAllChildNodes()
{
    // Retrieve user_id from session (middleware ensures it exists)
    $userId = Session::get('user_id');

    // Find the user's category node (or parent node) using their user_id
    $userNode = Category::where('user_id', $userId)->first();

    // If the user does not have a category node, return an empty view with a friendly message
    if (!$userNode) {
        $descendants = collect(); // Empty collection
        $message = 'User node not found in the tree.';
        return view('user.tree', compact('descendants', 'message'));
    }

    // Fetch all child nodes (descendants) of the user node based on the nested set model
    $descendants = Category::where('_lft', '>', $userNode->_lft)
                           ->where('_rgt', '<', $userNode->_rgt)
                           ->get();

    // Enhance each descendant by adding its parent name and referral code from the users table
    $descendants->transform(function ($descendant) {
        $parentName = DB::table('users')->where('id', $descendant->parent_id)->value('name');
        $descendant->parent_name = $parentName ?: 'N/A'; // Default to 'N/A' if no parent found

        $referralCode = DB::table('users')->where('id', $descendant->user_id)->value('referral_code');
        $descendant->referral_code = $referralCode ?: 'N/A';

        return $descendant;
    });

    // If no descendants are found, pass a custom message to the view
    $message = $descendants->isEmpty() ? 'No child nodes found for this user.' : null;

    // Pass the data to the Blade view
    return view('user.tree', compact('descendants', 'message'));
}
    
    // Fetch loans for a specific child user
    public function getLoansByChild(Request $request)
{
    $userId = $request->get('user_id');

    // Fetch loans for the selected child user, including the category name from loan_category table
    $loans = DB::table('loans')
               ->join('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')
               ->where('loans.user_id', $userId)
               ->select('loans.loan_reference_id', 'loans.amount', 'loans.status', 'loans.created_at', 'loan_category.category_name')
               ->get();

    return response()->json($loans);
}
}

   



    


