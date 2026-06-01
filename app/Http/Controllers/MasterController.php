<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bhk;
use App\Models\Amenity;

class MasterController extends Controller
{

    /* ================= BHK ================= */

    public function bhkList()
    {
        $bhks = Bhk::latest()->get();

        return view('admin.master.bhk-list', compact('bhks'));
    }

   public function bhkStore(Request $request)
{
    $request->merge([
        'bhk_name' => strtolower(trim($request->bhk_name))
    ]);

    $request->validate([
        'bhk_name' => 'required|unique:bhks,bhk_name'
    ]);

    Bhk::create([
        'bhk_name' => $request->bhk_name
    ]);

    return back()->with('success','BHK Added Successfully');
}

   public function bhkUpdate(Request $request)
{
    $request->validate([
        'bhk_name' => 'required|unique:bhks,bhk_name,'.$request->id
    ]);

    Bhk::where('id',$request->id)
        ->update([
            'bhk_name' => $request->bhk_name
        ]);

    return back()->with('success','BHK Updated Successfully');
}
    public function bhkDelete(Request $request)
    {
        Bhk::where('id',$request->id)->delete();

        return back()->with('success','BHK Deleted Successfully');
    }


    /* ================= AMENITIES ================= */

    public function amenitiesList()
    {
        $amenities = Amenity::latest()->get();

       return view('admin.master.amenities-list', compact('amenities'));
    }

public function amenitiesStore(Request $request)
{
    $request->merge([
        'amenity_name' => strtolower(trim($request->amenity_name))
    ]);

    $request->validate(
    [
        'amenity_name' => 'required|unique:amenities,amenity_name'
    ],
    [
        'amenity_name.unique' => 'Amenity already exists!',
        'amenity_name.required' => 'Amenity name is required!'
    ]);

    Amenity::create([
        'amenity_name' => $request->amenity_name
    ]);

    return back()->with('success','Amenity Added Successfully');
}
  public function amenitiesUpdate(Request $request)
{
    $request->merge([
        'amenity_name' => strtolower(trim($request->amenity_name))
    ]);

    $request->validate(
    [
        'amenity_name' => 'required|unique:amenities,amenity_name,'.$request->id
    ],
    [
        'amenity_name.unique' => 'Amenity already exists!',
        'amenity_name.required' => 'Amenity name is required!'
    ]);

    Amenity::where('id',$request->id)
    ->update([
        'amenity_name' => $request->amenity_name
    ]);

    return back()->with('success','Amenity Updated Successfully');
}
    public function amenitiesDelete(Request $request)
    {
        Amenity::where('id',$request->id)->delete();

        return back()->with('success','Amenity Deleted Successfully');
    }

}