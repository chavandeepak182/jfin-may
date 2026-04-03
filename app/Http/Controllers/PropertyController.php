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
use App\Models\Profile;
use App\Models\Property;
use App\Models\Range;
use App\Models\Activity;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Models\PropertyTaker;
use App\Models\States;
use App\Models\Cities;


class PropertyController extends Controller
{
    public function addProperty()
    {
        $data['range'] = DB::table('price_range')->get();
        $data['category'] = DB::table('property_category')->get();
        $data['localities'] = DB::table('localities')->get();
        $data['property_status'] = DB::table('property_status')->get();
         // ✅ ADD THIS LINE
    $data['states'] = States::all();
        return view('property.addProperty',compact('data'));
    }

public function getCities(Request $request)
{
    $state_id = $request->state_id;

    $cities = DB::table('cities')
        ->where('state_id', $state_id)
        ->get();

    return response()->json($cities);
}

public function insertProperty(Request $request)
{
$request->validate([
    'rera' => ['required', 'regex:/^P[0-9]{10,15}$/'],
    'property_type' => 'required',
    'land_type' => 'required',
], [
    'rera.regex' => 'Please enter proper RERA format (Example: P52100012345)',
    'property_type.required' => 'Please select Property Type',
    'land_type.required' => 'Please select Land Type',
]);
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';

    DB::beginTransaction();

    try {
        // Save the property details
        $p = new Property;
        $p->title = $request->property_title;
        $p->property_type_id = $request->property_type;
        $p->builder_name = $request->builder_name;
        $p->property_details = base64_encode($request->description);

        $p->address = $request->property_address;
        $p->state_id = $request->state_id;
            $p->city_id = $request->city_id;
            $p->locality_id = $request->area_id;

        // Handle Locality
       $locality = DB::table('localities')->where('id', $request->area_id)->value('name');
$p->localities = $locality ?? '';
$city_name = DB::table('cities')->where('id', $request->city_id)->value('city');
$p->city = $city_name ?? '';
       

        // Handle Property Status (save selected ID, not NULL)
       $p->property_status = $request->property_status ?? '';

        // Handle Amenities
        $amenities = $request->input('amenities', []); // Default to empty array if null
        $p->facilities = implode(', ', $amenities);

        $p->creator_id = $request->creator_id;
        $p->price_range_id = $request->price_range;
        $p->contact = $request->contact_number;
        $p->area = $request->area ?? '';
        $p->builtup_area = $request->builtup_area;
        $p->beds = $request->beds;
        $p->baths = $request->baths;
        $p->balconies = $request->balconies;
        $p->parking = $request->parking;
       
        $p->email = $request->email_id;
        $p->select_bhk = $request->select_bhk;
        $p->s_price = $request->s_price;
        $p->rera = $request->rera;
        $p->land_type = $request->land_type;
        $p->location = $request->input('location');
        $p->latitude = $request->input('latitude');
        $p->longitude = $request->input('longitude');
        $p->boucher = $this->handleFileUpload($request, 'property_voucher', 'property_brochures');

        // Handle nearby locations
        $nearby_locations = $request->input('nearby', []); // Default to empty array if null
        $p->nearby_locations = json_encode($nearby_locations);
       
            $p->is_active = 0;
            $p->is_deleted = 0;
            $p->image = '';
                $p->slug = '';
                $p->meta_title = '';
                $p->meta_description = '';
                $p->meta_keywords = '';
                $p->short_description = '';
                $p->maps_url = '';
                $p->schema_markup = '';


        // Save the property record
$p->save();

if ($request->hasFile('property_images')) {

    $images = $request->file('property_images');

    foreach ($images as $key => $image) {

        $image_name = uniqid().'_'.$image->getClientOriginalName();

        $destination = public_path('property_photos');

        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $image->move($destination, $image_name);

        $path = 'property_photos/'.$image_name;

        // first image as main property image
        if ($key == 0) {
            DB::table('properties')
                ->where('properties_id',$p->properties_id)
                ->update(['image'=>$path]);
        }

        DB::table('property_images')->insert([
            'properties_id' => $p->properties_id,
            'image_url' => $path,
            'is_featured' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
        // Commit transaction if successful
        DB::commit();
        
        return response()->json(['status' => 1, 'msg' => 'Property added successfully']);
        
}catch (\Exception $e) {
    DB::rollback();
    return response()->json([
        'status' => 0,
        'msg' => $e->getMessage()
    ]);
}
}

// count dashboard
public function propertylist()
{
    $properties = DB::table('properties')->count();
    $totalPendingProperties = DB::table('properties')
    ->where('is_active', 0)
    ->count();
    $totalPropertyTakers = DB::table('property_takers')->count();


     
    return view('admin.admin-property', compact('properties','totalPendingProperties','totalPropertyTakers'));
}

/**
 * Handle file uploads for single files.
 * 
 * @param Request $request
 * @param string $inputName - The name of the input field in the request
 * @param string $folder - The folder where the file should be saved
 * @return string - The file path of the uploaded file
 */
private function handleFileUpload(Request $request, $inputName, $folder)
{
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
    if ($request->hasFile($inputName)) {
        $file_name = substr(str_shuffle($permitted_chars), 0, 8) . time() . '.' . $request->file($inputName)->extension();
        $file_path = "$folder/" . $file_name;
        $request->file($inputName)->move(public_path($folder), $file_path);
        return $file_path;
    }
    return ""; // Return an empty string if no file was uploaded
}


// public function allProperties()
// {
//     // Get the logged-in user's role and ID from the session
//     $role_id = Session::get('role_id'); 
//     $user_id = Session::get('user_id'); 

//     // Base query for fetching properties with LEFT JOINs so no property is excluded
//     $query = DB::table('properties')
//         ->leftJoin('price_range', 'properties.price_range_id', '=', 'price_range.range_id')
//         ->leftJoin('property_category', 'properties.property_type_id', '=', 'property_category.pid')
//         ->select(
//             'properties.properties_id',
//             'properties.title',
//             'properties.property_type_id',
//             'properties.builder_name',
//             'properties.select_bhk',
//             'properties.land_type',
//             'properties.address',
//             'properties.rera',
//             'properties.facilities',
//             'properties.s_price',
//             'properties.beds',
//             'properties.baths',
//             'properties.balconies',
//             'properties.parking',
//             'properties.builtup_area',
//             'properties.contact',
//             'price_range.from_price',
//             'price_range.to_price',
//             'property_category.category_name'
//         );

//     // If the user is an agent (role_id == 3), show only their properties
//     if ($role_id == 3) {
//         $query->where('properties.creator_id', $user_id);
//     }

//     // ✅ Optional: Show only active properties
//     // $query->where('properties.is_active', 1);

//     // Paginate the results
//     $data['allProperties'] = $query->paginate(50);

//     // Return the view with the data
//     return view('property.allProperties', compact('data'));
// }


// public function allProperties(Request $request)
// {
    
//     /* ================= SESSION ================= */
//     $role_id = Session::get('role_id');
//     $user_id = Session::get('user_id');

//     /* ================= STATUS FILTER (NEW ADD) ================= */
//     $status = $request->status ?? 'all';

//     /* ================= COUNTS ================= */

//     $properties = DB::table('properties')->count();

//     $totalPendingProperties = DB::table('properties')
//         ->where('is_active', 0)
//         ->count();

//     $totalPropertyTakers = PropertyTaker::count();
//     $agents = User::all();
//     $totalVerifiedProperties = DB::table('properties')
//     ->where('is_active', 1)
//     ->count();

//     /* ================= PROPERTIES LIST ================= */
// $query = DB::table('properties')
//     ->leftJoin('price_range', 'properties.price_range_id', '=', 'price_range.range_id')
//     ->leftJoin('property_category', 'properties.property_type_id', '=', 'property_category.pid')
//     ->select(
//         'properties.*',
//         'price_range.from_price',
//         'price_range.to_price',
//         'property_category.category_name'
//     );

// /* ================= STATUS FILTER ================= */
// if ($request->status == 'pending') {
//     $query->where('properties.is_active', 0);
// }

// if ($request->status == 'verified') {
//     $query->where('properties.is_active', 1);
// }

// /* ================= SEARCH FILTER ================= */
// if ($request->search) {
//     $search = $request->search;

//     $query->where(function ($q) use ($search) {
//         $q->where('properties.title', 'like', "%$search%")
//           ->orWhere('properties.builder_name', 'like', "%$search%")
//           ->orWhere('properties.address', 'like', "%$search%");
//     });
// }

// /* ================= TYPE FILTER ================= */
// if ($request->type && $request->type != 'all') {
//     $query->where('property_category.category_name', $request->type);
// }

// /* ================= ROLE FILTER ================= */
// if ($role_id == 3) {
//     $query->where('properties.creator_id', $user_id);
// }

// $data['allProperties'] = $query->paginate(10)->withQueryString();
// // =========== PROPERTY TAKERS LIST ================= */

//     $propertyTakers = PropertyTaker::orderBy('id', 'desc')->paginate(10);

//     /* ================= VIEW ================= */

//     return view('property.allProperties', compact(
//         'data',
//         'properties',
//         'totalPendingProperties',
//         'totalPropertyTakers',
//         'propertyTakers',
//         'agents',
//         'totalVerifiedProperties', // 👈 ADD
//         'status'   // ✅ THIS LINE ADD
//     ));
// }

public function allProperties(Request $request)
{
    /* ================= SESSION ================= */
    $role_id = Session::get('role_id');
    $user_id = Session::get('user_id');

    /* ================= STATUS ================= */
 $status = $request->get('status', 'all');

if (!in_array($status, ['all', 'pending', 'verified'])) {
    $status = 'all';
}

    /* ================= COUNTS ================= */
    $properties = DB::table('properties')->count();

    $totalPendingProperties = DB::table('properties')
        ->where('is_active', 0)
        ->count();

    $totalVerifiedProperties = DB::table('properties')
        ->where('is_active', 1)
        ->count();

    

    /* ================= QUERY ================= */
    $query = DB::table('properties')
        ->leftJoin('price_range', 'properties.price_range_id', '=', 'price_range.range_id')
        ->leftJoin('property_category', 'properties.property_type_id', '=', 'property_category.pid')
        ->select(
            'properties.*',
            'price_range.from_price',
            'price_range.to_price',
            'property_category.category_name'
        );

    /* ================= STATUS FILTER ================= */
    if ($status == 'pending') {
        $query->where('properties.is_active', 0);
    }

    if ($status == 'verified') {
        $query->where('properties.is_active', 1);
    }

    /* ================= SEARCH ================= */
    if ($request->search) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('properties.title', 'like', "%$search%")
              ->orWhere('properties.builder_name', 'like', "%$search%")
              ->orWhere('properties.address', 'like', "%$search%");
        });
    }

    /* ================= TYPE FILTER ================= */
    if ($request->type && $request->type != 'all') {
        $query->where('property_category.category_name', $request->type);
    }

    /* ================= ROLE FILTER ================= */
    // if ($role_id == 3) {
    //     $query->where('properties.creator_id', $user_id);
    // }

   $data['allProperties'] = $query->paginate(10);

    /* ================= PROPERTY TAKERS ================= */
   

    /* ================= RETURN VIEW ================= */
    return view('property.allProperties', compact(
        'data',
        'properties',
        'totalPendingProperties',
       
        
        
        'totalVerifiedProperties',
        'status'
    ));
}
public function updatePropertyStatus(Request $request)
{

    $property_id = $request->property_id;
    $status = $request->status;

    DB::table('properties')
        ->where('properties_id',$property_id)
        ->update([
            'is_active'=>$status
        ]);

    return response()->json([
        'status'=>1,
        'msg'=>'Property status updated successfully'
    ]);

}

    public function pendingProperties()
    {
            $data['allProperties'] = DB::table('properties')
        ->join('price_range', 'properties.price_range_id', '=', 'price_range.range_id')
        ->join('property_category', 'properties.property_type_id', '=', 'property_category.pid')
        ->where('properties.is_active',0)
        ->select('properties.properties_id', 'properties.title', 'properties.property_type_id', 'properties.builder_name','properties.select_bhk', 'properties.land_type',
        'properties.address','properties.facilities', 'properties.rera', 'properties.s_price', 'properties.builtup_area', 'properties.beds', 'properties.baths', 'properties.balconies', 'properties.parking', 'properties.contact', 'price_range.from_price', 'price_range.to_price', 'property_category.category_name')
        ->paginate(50);
        
        return view('property.pendingProperties',compact('data'));
    }

    public function viewDetails($property_id) {
        // Fetch property details
  $data['propertie_details'] = DB::table('properties as p')
    ->leftJoin('price_range as pr', 'p.price_range_id', '=', 'pr.range_id')
    ->leftJoin('property_category as pc', 'pc.pid', '=', 'p.property_type_id')
    ->select(
        'p.*',
        'pr.from_price',
        'pr.to_price',
        'pc.category_name'
    )
    ->where('p.properties_id', $property_id)
    ->get();
    
        // Fetch all images for the property
        $data['property_images'] = DB::table('property_images')
        ->where('properties_id', $property_id)
        ->get();
    
        return view('property.propertyDetails', compact('data'));
    }
    public function activate(Request $request){
        $updatePropertie = array(
            'is_active'=> 1
        );

        try{        
            $property_id = $request->propertie_id;    
            $update_propertie = DB::table('properties')->where('properties_id',$property_id)->update($updatePropertie);
           
            if($update_propertie){

                //activity logs
                $username = Session::get('username');
                $user_id = Session::get('user_id');
                $details = "Property Activated successfully by ".$username; 
                app(UsersController::class)->insertActivityLogs($user_id, $details);
                //end of activity logs   

                return response()->json(['status'=>1,'msg'=>'Propertie is successfully activated !']);
            }
        }catch (\Exception $e) {
            DB::rollback();            
            dd($e->getMessage());
        }
    }
    public function getAreas($city_id)
{
    return DB::table('localities')
        ->where('city_id', $city_id)
        ->get();
}

  public function editProperty($property_id)
{
    $data['range'] = DB::table('price_range')->get();
    $data['category'] = DB::table('property_category')->get();

    // ✅ MAIN FIX (NO SELECT * ISSUE)
  $data['propertie_details'] = DB::table('properties as p')
    ->leftJoin('price_range as pr', 'p.price_range_id', '=', 'pr.range_id')
    ->leftJoin('property_category as pc', 'pc.pid', '=', 'p.property_type_id')
    ->select(
        'p.*',
        'pr.from_price',
        'pr.to_price'
    )
    ->where('p.properties_id', $property_id)
    ->get();

    // ✅ Images
    $data['property_images'] = DB::table('property_images')
        ->where('properties_id', $property_id)
        ->get();

    // ✅ Dropdown data
    $data['states'] = States::all();
    $data['localities'] = DB::table('localities')->get();

    return view('property.editProperty', compact('data'));
}
public function updatePropertie(Request $request)
{
    
    
    $propertie_id = $request->propertie_id;

    // ✅ GET PROPERTY
    $property = DB::table('properties')->where('properties_id', $propertie_id)->first();

    if (!$property) {
        return response()->json([
            'status' => 0,
            'msg' => 'Property not found'
        ]);
    }

    $old_image = $property->image;
    $old_boucher = $property->boucher;

    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';

    /* ================= IMAGE UPLOAD ================= */
   if ($request->hasFile('property_image')) {

    $file = $request->file('property_image');

    $image_name = substr(str_shuffle($permitted_chars), 0, 8) . time() . '.' . $file->getClientOriginalExtension();

    $destination = public_path('property_photos');

    if (!file_exists($destination)) {
        mkdir($destination, 0755, true);
    }

    $file->move($destination, $image_name);

    $property_image_name = 'property_photos/' . $image_name;

} else {
    $property_image_name = $old_image;
}

    /* ================= VOUCHER UPLOAD ================= */
    if ($request->hasFile('property_voucher')) {

        $file_name = substr(str_shuffle($permitted_chars), 0, 8) . time() . '.' . $request->property_voucher->extension();

        $destination = public_path('property_bouchers');

        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $request->property_voucher->move($destination, $file_name);

        $property_voucher = 'property_bouchers/' . $file_name;

    } else {
        $property_voucher = $old_boucher;
    }

    /* ================= SAFE VALUES ================= */
 $city_id = $request->city_id;
$area_id = $request->area_id;

    $city_name = DB::table('cities')->where('id', $city_id)->value('city') ?? '';
    $area_name = DB::table('localities')->where('id', $area_id)->value('name') ?? '';

    /* ================= UPDATE DATA ================= */
    $amenities = $request->input('amenities', []);
    $updateProperty = [

        'title' => $request->property_title,
        'property_type_id' => $request->property_type_id,
        'builder_name' => $request->builder_name,
        's_price' => $request->s_price,
        'select_bhk' => $request->select_bhk,
       'property_details' => base64_encode($request->description),
        'address' => $request->property_address,

        'email' => $request->email_id,
        'contact' => $request->contact_number,
        'price_range_id' => $request->price_range,
        'creator_id' => $request->creator_id,
        

        // ✅ IMAGE
        'image' => $property_image_name,

        // ✅ VOUCHER
        'boucher' => $property_voucher,

        // ✅ AMENITIES SAFE
    //   $amenities = $request->input('amenities', []);
'facilities' => !empty($amenities) ? implode(', ', $amenities) : $property->facilities,

        'area' => !empty($request->area) ? $request->area : '',
        'builtup_area' => $request->builtup_area,

        // ✅ LOCATION ID
        'state_id' => $request->state_id,
        'city_id' => $city_id,
        'locality_id' => $area_id,

        // ✅ LOCATION NAMES (IMPORTANT FOR DISPLAY)
        'city' => $city_name,
        'localities' => $area_name,

        'rera' => $request->rera,
        'beds' => $request->beds,
        'baths' => $request->baths,
        'balconies' => $request->balconies,
        'parking' => $request->parking,

        'location' => $request->location,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'land_type' => $request->land_type,
    ];

    try {

        DB::table('properties')
            ->where('properties_id', $propertie_id)
            ->update($updateProperty);

        /* ================= MULTIPLE IMAGES ================= */
        if ($request->hasFile('additional_images')) {

            foreach ($request->file('additional_images') as $image) {

                $img_name = time() . rand(1000, 9999) . '.' . $image->extension();

                $destination = public_path('property_photos');

                if (!file_exists($destination)) {
                    mkdir($destination, 0755, true);
                }

                $image->move($destination, $img_name);

                DB::table('property_images')->insert([
                    'properties_id' => $propertie_id,
                    'image_url' => 'property_photos/' . $img_name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return response()->json([
            'status' => 1,
            'msg' => 'Property updated successfully'
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'status' => 0,
            'msg' => $e->getMessage(),
            'line' => $e->getLine()
        ]);
    }
}

    public function deletePropertie(Request $request){
          //activity logs
          $username = Session::get('username');
          $user_id = Session::get('user_id');
          $details = "Property id - [". $request->propertie_id  ."] deleted successfully by ".$username; 
          app(UsersController::class)->insertActivityLogs($user_id, $details);
      //end of activity logs   

        try{ 
            $propertie_id = $request->propertie_id;    
            $propertie = DB::table('properties')->where('properties_id', $propertie_id)->delete();

          
            if($propertie){
                return response()->json(['status'=>1,'msg'=>'Property deleted successfully !']);
            }
        }catch (\Exception $e) {
            DB::rollback();            
            dd($e->getMessage());
        }
    }


}