<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    // Show all blogs in admin
    // public function index()
    // {
    //     $blogs = DB::table('blog')
    // ->orderBy('id', 'desc') // latest first
    // ->get();

    //     return view('blog.index', compact('blogs'));
    // }

    public function adminBlog()
{
    // Fetch all blogs
    $blogs = DB::table('blog')
        ->select('id', 'category_id', 'image', 'blog_name', 'description', 'slug', 'meta_title', 'meta_keywords', 'meta_description', 'created_at', 'updated_at', 'schema_markup', 'publish_date', 'tag', 'status', 'author_name')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('admin.admin-blog', compact('blogs'));
}



  public function index()
{
    $blogs = DB::table('blog')->select('blog.*')->get();
    $blogCount = $blogs->count();

    return view('blog.index', compact('blogs', 'blogCount'));
}



    // Show create form
    public function create()
    {
        $categories = DB::table('blog_category')->get();
        return view('blog.create', compact('categories'));
    }

    // Store new blog
  


    
public function storeService(Request $request)
{
    $request->validate([
        'blog_name' => 'required|string|max:255',
        'category_id'  => 'required|integer',
        'description' => 'nullable|string',
        'slug' => 'nullable|string|max:255',
        'meta_title' => 'nullable|string|max:255',
        'meta_keywords' => 'nullable|string',
        'publish_date' => 'nullable|string',
        'status' => 'nullable|string',
        'author_name' => 'nullable|string',
        'tag' => 'nullable|string',
        'schema_markup' => 'nullable|string',
        'meta_description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
    ]);

    $imagePath = null;

    if ($request->hasFile('image')) {
        
        $imagePath = $request->file('image')->store('blogs', 'public');
    }

    DB::table('blog')->insert([
        'blog_name' => $request->blog_name,
        'category_id' => $request->category_id,
        'description' => $request->description,
        'slug' => $request->slug,
        'meta_title' => $request->meta_title,
        'meta_keywords' => $request->meta_keywords,
        'meta_description' => $request->meta_description,
        'publish_date' => $request->publish_date,
        'status' => $request->status,
        'schema_markup' => $request->schema_markup,
        'tag' => $request->tag,
        'author_name' => $request->author_name,
        'image' => $imagePath,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('blogs.index')->with('success', 'Blog added successfully.');
}


    

    // Show edit form
    public function edit($id)
    {
        $blog = DB::table('blog')->where('id', $id)->first();

        if (!$blog) {
            return redirect()->route('blogs.index')->with('error', 'Blog not found.');
        }

        $categories = DB::table('blog_category')->get();
        return view('blog.edit', compact('blog', 'categories'));
    }

    // Update blog
public function update(Request $request, $id)
{
    $request->validate([
        'blog_name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'slug' => 'nullable|string|max:255',
        'meta_title' => 'nullable|string|max:255',
        'meta_keywords' => 'nullable|string',
        'publish_date' => 'nullable|date',
        'status' => 'nullable|string',
        'author_name' => 'nullable|string|max:255',
        'tag' => 'nullable|string',
        'schema_markup' => 'nullable|string',
        'meta_description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
    ]);

    $blog = DB::table('blog')->where('id', $id)->first();

    if (!$blog) {
        return redirect()->route('blogs.index')->with('error', 'Blog not found.');
    }

    $imagePath = $blog->image;

    if ($request->hasFile('image')) {
        // जुनी image delete करणे
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }

        // नवी image save करणे
        $imagePath = $request->file('image')->store('blogs', 'public');
    }

    DB::table('blog')->where('id', $id)->update([
        'blog_name' => $request->blog_name,
        'description' => $request->description,
        'slug' => $request->slug,
        'meta_title' => $request->meta_title,
        'meta_keywords' => $request->meta_keywords,
        'meta_description' => $request->meta_description,
        'publish_date' => $request->publish_date,
        'status' => $request->status ?? 'inactive',
        'schema_markup' => $request->schema_markup,
        'tag' => $request->tag,
        'author_name' => $request->author_name,
        'image' => $imagePath,
        'updated_at' => now(),
    ]);

    return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
}


    // Delete blog
    public function deleteService($id)
    {
        $blog = DB::table('blog')->where('id', $id)->first();

        if (!$blog) {
            return redirect()->route('blogs.index')->with('error', 'Blog not found.');
        }

        if ($blog->image && File::exists(public_path($blog->image))) {
            File::delete(public_path($blog->image));
        }

        DB::table('blog')->where('id', $id)->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
    }
}




// class BlogController extends Controller {
//     public function index() {
//         $blogs = Blog::where('status', 'published')->paginate(10);
//         return view('blogs.index', compact('blogs'));
//     }
//     public function edit($id) {
//         $blog = Blog::findOrFail($id);
//         $categories = BlogCategory::all();
//         return view('blogs.edit', compact('blog', 'categories'));
//     }

//     public function update(Request $request, $id) {
//         $request->validate([
//             'title' => 'required',
//             'category_id' => 'required',
//             'experience' => 'nullable|string|max:255',
//             'openings' => 'nullable|string|max:255',
//             'location' => 'nullable|string|max:255',
//             'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//         ]);
    
//         $blog = Blog::findOrFail($id);
    
//         $blog->update([
//             'title' => $request->title,
//             'slug' => Str::slug($request->title),
//             'category_id' => $request->category_id,
//             'experience' => $request->experience,
//             'openings' => $request->openings,
//             'location' => $request->location,
//             'published_at' => now(),
//             'status' => $request->status,
//         ]);
    
//         return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
//     }
    
//     public function showById($id) 
//     {
//         // Fetch the blog details
//         $blog = Blog::join('blog_categories', 'blogs.category_id', '=', 'blog_categories.id')
//                     ->where('blogs.id', $id)
//                     ->select('blogs.*', 'blog_categories.name as category_name')
//                     ->firstOrFail();
//         $comments = BlogComment::where('blog_id', $id)
//                     ->where('is_approved', 1)
//                     ->latest()
//                     ->get();
    
//         // Fetch Featured Properties
//         $featuredProperties = DB::table('properties')
//             ->join('price_range', 'properties.price_range_id', '=', 'price_range.range_id')
//             ->join('property_category', 'properties.property_type_id', '=', 'property_category.pid')
//             ->where('properties.is_featured', 1)
//             ->where('properties.is_active', 1)
//             ->select(
//                 'properties.properties_id', 'properties.title', 'properties.address', 'properties.builder_name',
//                 'properties.s_price', 'properties.is_featured', 'properties.localities', 'properties.city',
//                 'property_category.category_name', 'price_range.from_price', 'properties.select_bhk', 'properties.area',
//                 'price_range.from_price', 'price_range.to_price'
//             )
//             ->get();
    
//         // Fetch images for featured properties
//         $propertyImages = DB::table('property_images')
//             ->whereIn('properties_id', $featuredProperties->pluck('properties_id'))
//             ->select('properties_id', 'image_url')
//             ->orderBy('is_featured', 'DESC')
//             ->get()
//             ->groupBy('properties_id');
    
//         // Attach images to featured properties
//         foreach ($featuredProperties as $featured) {
//             $featured->image = isset($propertyImages[$featured->properties_id])
//                 ? env('baseURL') . "/" . $propertyImages[$featured->properties_id]->first()->image_url
//                 : env('baseURL') . "/theme/frontend/img/default.jpg"; // Default image if no image found
//         }
//          // Fetch Featured Blogs
//             $featuredBlogs = Blog::where('is_featured', 1)
//             ->where('is_active', 1)
//             ->select('id', 'title', 'image', 'created_at')
//             ->orderBy('created_at', 'DESC')
//             ->take(5) // Limit to 5 blogs
//             ->get();
    
//         return view('blogs.show', compact('blog', 'featuredProperties', 'featuredBlogs', 'comments'));
//     }

//     public function show($slug) {
//         $blog = Blog::where('slug', $slug)->firstOrFail();
//         return view('blogs.show', compact('blog'));
//     }

//     public function create() {
//         $categories = BlogCategory::all();
//         return view('blogs.create', compact('categories'));
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'title' => 'required|string|max:255',
//             'category_id' => 'required',
//             'experience' => 'nullable|string|max:255',
//             'openings' => 'nullable|string|max:255',
//             'location' => 'nullable|string|max:255',
//             'status' => 'required|in:draft,published',
//         ]);

//         Blog::create([
//             'title' => $request->title,
//             'slug' => Str::slug($request->title),
//             'category_id' => $request->category_id,
//             'experience' => $request->experience,
//             'openings' => $request->openings,
//             'location' => $request->location,
//             'published_at' => now(),
//             'status' => $request->status,
//         ]);

//         return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
//     }


//     public function toggleStatus($id) {
//         $blog = Blog::findOrFail($id);
//         $blog->is_active = !$blog->is_active;
//         $blog->save();
    
//         return redirect()->back()->with('success', 'Blog status updated successfully.');
//     }

//     public function bloglist()
//     {
//         $careers = Blog::with('category')
//             ->where('status', 'published')
//             ->orderBy('created_at', 'desc')
//             ->paginate(10);
    
//         return view('frontend.careers', compact('careers'));
//     }


//     public function storeComment(Request $request)
//     {
//         $request->validate([
//             'blog_id' => 'required|exists:blogs,id',
//             'name' => 'required|string|max:255',
//             'email' => 'required|email|max:255',
//             'message' => 'required|string',
//         ]);

//         BlogComment::create($request->only('blog_id', 'name', 'email', 'message'));

//         return back()->with('success', 'Comment submitted successfully.');
//     }
//     public function pendingComments()
//     {
//         $comments = BlogComment::where('is_approved', 0)->latest()->get();
//         return view('blogs.blog-comments.index', compact('comments'));
//     }

//     public function approveComment($id)
//     {
//         BlogComment::where('id', $id)->update(['is_approved' => 1]);
//         return back()->with('success', 'Comment approved successfully.');
//     }

//     public function deleteComment($id)
//     {
//         BlogComment::where('id', $id)->delete();
//         return back()->with('success', 'Comment deleted successfully.');
//     }

//     public function destroy($id)
//     {
//         $blog = Blog::findOrFail($id);
//         $blog->delete();

//         return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
//     }

// }
