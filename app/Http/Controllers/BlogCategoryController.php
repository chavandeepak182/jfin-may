<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogCategoryController extends Controller
{
    // Show all categories
    public function index()
{
    $categories = DB::table('blog_category')->get(); // All categories
      $categoryCount = $categories->count();

    return view('blogcategories.index', compact('categories', 'categoryCount'));
}


    // Store new category
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:45',
        ]);

        DB::table('blog_category')->insert([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('blog.categories.index')->with('success', 'Category added successfully.');
    }

    // Edit category
    public function edit($pid)
    {
        $category = DB::table('blog_category')->where('pid', $pid)->first();
        return view('blogcategories.edit', compact('category'));
    }

    // Update category
    public function update(Request $request, $pid)
    {
        $request->validate([
            'category_name' => 'required|string|max:45',
        ]);

        DB::table('blog_category')->where('pid', $pid)->update([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('blog.categories.index')->with('success', 'Category updated successfully.');
    }

    // Delete category
    public function destroy($pid)
    {
        DB::table('blog_category')->where('pid', $pid)->delete();
        return redirect()->route('blog.categories.index')->with('success', 'Category deleted successfully.');
    }
}
