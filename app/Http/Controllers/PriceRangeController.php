<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PriceRangeController extends Controller
{
    public function index()
    {
        $ranges = DB::table('price_range')->get();
        return view('admin.price_range.index', compact('ranges'));
    }

    public function create()
    {
        return view('admin.price_range.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'from_price' => 'required|numeric',
        'to_price'   => 'required|numeric|gt:from_price',
    ]);

    // Duplicate check
    $exists = DB::table('price_range')
        ->where('from_price', $request->from_price)
        ->where('to_price', $request->to_price)
        ->exists();

    if($exists){
        return redirect()->back()
            ->withErrors([
                'duplicate' => 'Price range already exists!'
            ])
            ->withInput();
    }

    DB::table('price_range')->insert([
        'from_price' => $request->from_price,
        'to_price'   => $request->to_price,
    ]);

    return redirect('admin/price-range')
        ->with('success', 'Added Successfully');
}

    public function edit($id)
    {
        $range = DB::table('price_range')->where('range_id', $id)->first();
        return view('admin.price_range.edit', compact('range'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'from_price' => 'required|numeric',
            'to_price'   => 'required|numeric|gt:from_price',
        ]);

        DB::table('price_range')
            ->where('range_id', $id)
            ->update([
                'from_price' => $request->from_price,
                'to_price'   => $request->to_price,
            ]);

        return redirect('admin/price-range')->with('success', 'Updated Successfully');
    }

    public function destroy($id)
    {
        DB::table('price_range')->where('range_id', $id)->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
