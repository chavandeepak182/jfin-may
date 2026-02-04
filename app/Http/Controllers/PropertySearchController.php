<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PropertySearchController extends Controller
{
    public function index(Request $request)
    {
         dd($request->q);
    //     $query = DB::table('properties');

    //     // 🔍 Search keyword
    //     if ($request->filled('q')) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('locality', 'LIKE', '%' . $request->q . '%')
    //               ->orWhere('project_name', 'LIKE', '%' . $request->q . '%')
    //               ->orWhere('developer', 'LIKE', '%' . $request->q . '%');
    //         });
    //     }

    //     // 🏠 Property Type
    //     if ($request->filled('property_type')) {
    //         $query->where('property_type', $request->property_type);
    //     }

    //     // 🛏 BHK
    //     if ($request->filled('bhk')) {
    //         $request->bhk == 4
    //             ? $query->where('bhk', '>=', 4)
    //             : $query->where('bhk', $request->bhk);
    //     }

    //     // 💰 Budget
    //     if ($request->filled('budget')) {
    //         if ($request->budget === '200+') {
    //             $query->where('price', '>=', 20000000);
    //         } else {
    //             [$min, $max] = explode('-', $request->budget);
    //             $query->whereBetween('price', [
    //                 $min * 100000,
    //                 $max * 100000
    //             ]);
    //         }
    //     }

    //     $properties = $query->paginate(10)->withQueryString();

    //     return view('properties', compact('properties'));
    }
}
