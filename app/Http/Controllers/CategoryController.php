<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function showTree()
{
    // Fetch all categories
    $categories = DB::table('categories')
        ->select('id', 'name', 'user_id', 'parent_id', '_lft', '_rgt')
        ->orderBy('_lft', 'asc') // Ensure proper tree structure order
        ->get();

    // Structure the tree using recursion
    $tree = $this->buildTree($categories);

    return view('admin.tree', compact('tree'));
}

/**
 * Build a hierarchical tree from a flat dataset.
 */
private function buildTree($categories, $parentId = null)
{
    $tree = [];
    foreach ($categories as $category) {
        if ($category->parent_id == $parentId) {
            $children = $this->buildTree($categories, $category->user_id);
            $tree[] = [
                'id' => $category->id,
                'name' => $category->name,
                'user_id' => $category->user_id,
                'children' => $children,
            ];
        }
    }
    return $tree;
}
    public function store(Request $request)
{
    $parentUserId = $request->input('parent_user_id'); // Parent's user_id (optional)
    $childUserId = $request->input('user_id'); // New child's user_id
    $childName = $request->input('category'); // Name of the new node

    // If no referral is provided, find the next available node
    if (!$parentUserId) {
        \Log::info("No referral provided. Searching for the next available empty node.");
        $parentNode = $this->findNextAvailableNode();

        if (!$parentNode) {
            \Log::error("No available position found in the tree.");
            return response()->json(['error' => 'No available position in the tree'], 422);
        }

        $parentUserId = $parentNode->user_id; // Assign the found parent's user_id
    }

    // Add the new user node
    $result = $this->addNode($parentUserId, $childName, $childUserId);

    if ($result) {
        return response()->json(['status' => 1, 'msg' => 'Node added successfully']);
    } else {
        return response()->json(['status' => 0, 'msg' => 'Failed to add node'], 500);
    }
}
public function findNextAvailableNode()
{
    // Fetch the root node (assuming root has `parent_id = null`)
    $rootNode = DB::table('categories')->whereNull('parent_id')->first();

    if (!$rootNode) {
        \Log::error("Root node not found.");
        return null;
    }

    // Perform a breadth-first search (BFS) to find the next available node
    $queue = [$rootNode]; // Start with the root node

    while (!empty($queue)) {
        $currentNode = array_shift($queue); // Dequeue the first node

        // Count children of the current node
        $childrenCount = DB::table('categories')->where('parent_id', $currentNode->user_id)->count();

        if ($childrenCount < 2) {
            // Found a node with an empty position
            return $currentNode;
        }

        // Enqueue the children of the current node for further traversal
        $children = DB::table('categories')->where('parent_id', $currentNode->user_id)->get();
        foreach ($children as $child) {
            $queue[] = $child;
        }
    }

    // No available position found
    return null;
}
    /**
     * Add a node under a specific parent ID or find the next available position.
     */
    public function addNode($parentUserId, $childName, $childUserId)
{
    \Log::info("Adding node: Parent User ID: $parentUserId, Child Name: $childName, Child User ID: $childUserId");

    // Validate the parent category
    $parentCategory = DB::table('categories')->where('user_id', $parentUserId)->first();

    if (!$parentCategory) {
        \Log::error("Parent category not found for User ID: $parentUserId");
        return false;
    }

    // Count existing children
    $childCount = DB::table('categories')->where('parent_id', $parentCategory->user_id)->count();

    if ($childCount < 2) {
        // Insert the new child node
        return $this->insertNode($parentCategory, $childName, $childUserId);
    } else {
        \Log::info("Parent User ID={$parentUserId} already has 2 children. Searching for next available node.");
        return false; // Shouldn't reach here due to pre-checks
    }
}
    
    /**
     * Helper function to insert a new node.
     */
    private function insertNode($parentCategory, $childName, $childUserId)
    {
        DB::beginTransaction();
    
        try {
            // Shift _lft and _rgt for all affected nodes
            DB::table('categories')
                ->where('_rgt', '>=', $parentCategory->_rgt)
                ->increment('_rgt', 2);
    
            DB::table('categories')
                ->where('_lft', '>', $parentCategory->_rgt)
                ->increment('_lft', 2);
    
            // Insert the new child node
            DB::table('categories')->insert([
                'name' => $childName,
                'user_id' => $childUserId,
                'parent_id' => $parentCategory->user_id,
                '_lft' => $parentCategory->_rgt, // Set _lft equal to parent's _rgt
                '_rgt' => $parentCategory->_rgt + 1, // Set _rgt to _lft + 1
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            DB::commit();
            \Log::info("Node successfully inserted: Parent User ID: {$parentCategory->user_id}, Child Name: {$childName}, Child User ID: {$childUserId}");
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Failed to insert node: {$e->getMessage()}");
            return false;
        }
    }
public function addUserToTree($parentId, $user)
{
    // Find the parent node where the user will be added
    $parentNode = Category::find($parentId);

    if (!$parentNode) {
        \Log::error("Parent category not found for ID: {$parentId}");
        return response()->json(['error' => 'Parent category not found'], 404);
    }

    // Check for existing children (binary tree can have 2 children max)
    $childCount = $parentNode->children()->count();
    \Log::info("Parent Node ID={$parentNode->id} has {$childCount} children.");

    if ($childCount >= 2) {
        \Log::warning("Parent Node ID={$parentNode->id} cannot have more than two children.");
        return response()->json(['error' => 'A binary tree node cannot have more than two children'], 422);
    }

    // Create the new user node
    $newNode = new Category();
    $newNode->name = $user->name;  // User name
    $newNode->user_id = $user->id;  // Store the user_id

    // Append the new node under the parent node
    $parentNode->appendNode($newNode);
    \Log::info("New Node '{$newNode->name}' added under Parent ID={$parentNode->id}");

    return response()->json(['message' => 'User added successfully to the tree'], 200);
}

    /**
     * Recursive function to find the next available position for a new node.
     */
    public function addNodeToNextAvailable($node, $newNode)
    {
        $leftChild = $node->children()->first();
        $rightChild = $node->children()->skip(1)->first();

        if (is_null($leftChild)) {
            $node->appendNode($newNode);
            \Log::info("Node '{$newNode->name}' added as the left child of Node ID={$node->id}");
        } elseif (is_null($rightChild)) {
            $node->appendNode($newNode);
            \Log::info("Node '{$newNode->name}' added as the right child of Node ID={$node->id}");
        } else {
            \Log::info("Both children occupied for Node ID={$node->id}. Recursing to find next available position.");
            $this->addNodeToNextAvailable($leftChild, $newNode);
        }
    }

    /**
     * Distribute commission for a loan based on the tree structure.
     */
    public function commissionDistribution($applicantUserId, $amount)
{
    \Log::info("Starting commission distribution for Applicant User ID: $applicantUserId, Amount: $amount");

    // Fetch the category node for the applicant
    $applicantCategory = DB::table('categories')->where('user_id', $applicantUserId)->first();

    if (!$applicantCategory) {
        \Log::warning("Category not found for Applicant User ID: $applicantUserId. Skipping commission distribution.");
        return;
    }

    // Fetch ancestors for the applicant
    $ancestors = DB::table('categories')
        ->where('_lft', '<', $applicantCategory->_lft)  // Ancestors have _lft less than current node's _lft
        ->where('_rgt', '>', $applicantCategory->_rgt) // Ancestors have _rgt greater than current node's _rgt
        ->orderBy('_lft', 'asc') // Retrieve ancestors in hierarchical order (top to bottom)
        ->get();

    if ($ancestors->isEmpty()) {
        \Log::info("No ancestors found for Applicant User ID: $applicantUserId. Skipping commission distribution.");
        return;
    }

    // Fetch the commission percentage
    $commissionRecord = DB::table('commission')->latest('com_id')->first();

    if (!$commissionRecord) {
        \Log::error("No commission record found.");
        return;
    }

    $commissionPercentage = (float) $commissionRecord->commission_amount;
    $totalCommission = $amount * $commissionPercentage / 100;
    $share = $totalCommission / $ancestors->count(); // Split equally among ancestors

    \Log::info("Commission Percentage: {$commissionPercentage}%, Total Commission: {$totalCommission}, Share per ancestor: {$share}");

    // Distribute commission to each ancestor
    foreach ($ancestors as $ancestor) {
        if (!$ancestor->user_id) {
            \Log::warning("Skipping ancestor with invalid User ID: {$ancestor->user_id}");
            continue;
        }

        // Update wallet for ancestor
        $wallet = DB::table('wallet')->where('user_id', $ancestor->user_id)->first();

        if (!$wallet) {
            // Create wallet if not exists
            DB::table('wallet')->insert([
                'user_id' => $ancestor->user_id,
                'wallet_balance' => $share,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            // Increment wallet balance
            DB::table('wallet')->where('user_id', $ancestor->user_id)->increment('wallet_balance', $share);
        }

        \Log::info("Distributed {$share} commission to Ancestor User ID={$ancestor->user_id}");
    }

    \Log::info("Commission distribution completed for Applicant User ID: $applicantUserId");
}
/**
 * Update or create a wallet for a user.
 */
private function updateWallet($userId, $amount)
{
    $wallet = DB::table('wallet')->where('user_id', $userId)->first();

    if (!$wallet) {
        // Create wallet if not exists
        DB::table('wallet')->insert([
            'user_id' => $userId,
            'wallet_balance' => $amount,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \Log::info("Created wallet and added {$amount} for User ID: {$userId}");
    } else {
        // Increment wallet balance
        DB::table('wallet')->where('user_id', $userId)->increment('wallet_balance', $amount);
        \Log::info("Updated wallet by adding {$amount} for User ID: {$userId}");
    }
}
}
