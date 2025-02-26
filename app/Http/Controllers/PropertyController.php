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



class PropertyController extends Controller
{
    public function addProperty()
    {
        $data['range'] = DB::table('price_range')->get();
        $data['category'] = DB::table('property_category')->get();
        $data['localities'] = DB::table('localities')->get();
        return view('property.addProperty',compact('data'));
    }

    public function insertProperty(Request $request)
{
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';

    DB::beginTransaction();

    try {
        // Save the property details
        $p = new Property;
        $p->title = $request->property_title;
        $p->property_type_id = $request->property_type;
        $p->builder_name = $request->builder_name;
        $p->property_details = $request->property_description;
        $p->address = $request->property_address;

        // Handle Amenities
        $amenities = $request->input('amenities', []); // Default to an empty array if null
        $p->facilities = implode(', ', $amenities);

        $p->creator_id = $request->creator_id;
        $p->price_range_id = $request->price_range;
        $p->contact = $request->contact_number;
        $p->area = $request->area;
        $p->builtup_area = $request->builtup_area;
        $p->localities = $request->localitie;
        $p->beds = $request->beds;
        $p->baths = $request->baths;
        $p->balconies = $request->balconies;
        $p->parking = $request->parking;
        $p->city = $request->city;
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

        // Save the property record
        $p->save();

        // Save multiple images in the `property_images` table
        if ($request->hasFile('property_images')) {
            foreach ($request->file('property_images') as $property_image) {
                $image_name = substr(str_shuffle($permitted_chars), 0, 8) . time() . '.' . $property_image->extension();
                $image_path = "property_photos/" . $image_name;
                $property_image->move(public_path('property_photos'), $image_path);

                // Insert into `property_images` table
                DB::table('property_images')->insert([
                    'properties_id' => $p->id, // Use the correct property ID
                    'image_url' => $image_path,
                    'is_featured' => 0, // Default to non-featured
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Commit transaction if successful
        DB::commit();
        return response()->json(['status' => 1, 'msg' => 'Property added successfully']);

    } catch (\Exception $e) {
        DB::rollback();
        return response()->json(['status' => 0, 'msg' => $e->getMessage()]);
    }
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


    public function allProperties()
{
    // Get the logged-in user's role and ID from the session
    $role_id = Session::get('role_id'); // Assuming role_id is stored in the session
    $user_id = Session::get('user_id'); // Assuming user_id is stored in the session

    // Base query for fetching properties
    $query = DB::table('properties')
        ->join('price_range', 'properties.price_range_id', '=', 'price_range.range_id')
        ->join('property_category', 'properties.property_type_id', '=', 'property_category.pid')
        ->where('properties.is_active', 1)
        ->select(
            'properties.properties_id',
            'properties.title',
            'properties.property_type_id',
            'properties.builder_name',
            'properties.select_bhk',
            'properties.land_type',
            'properties.address',
            'properties.rera',
            'properties.facilities',
            'properties.s_price',
            'properties.beds',
            'properties.baths',
            'properties.balconies',
            'properties.parking',
            'properties.builtup_area',
            'properties.contact',
            'price_range.from_price',
            'price_range.to_price',
            'property_category.category_name'
        );

    // If the user is an agent (role_id == 3), show only their properties
    if ($role_id == 3) {
        $query->where('properties.creator_id', $user_id);
    }

    // Paginate the results
    $data['allProperties'] = $query->paginate(50);

    // Return the view with the data
    return view('property.allProperties', compact('data'));
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
        $data['propertie_details'] = DB::select('SELECT * 
            FROM properties AS p
            JOIN price_range AS pr ON p.price_range_id = pr.range_id
            JOIN property_category AS pc ON pc.pid = p.property_type_id
            WHERE p.properties_id = ?', [$property_id]
        );
    
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

    public function editProperty($property_id) {
        $data['range'] = DB::table('price_range')->get();
        $data['category'] = DB::table('property_category')->get();
        $data['propertie_details'] = DB::select('SELECT * 
                                                 FROM properties AS p
                                                 JOIN price_range AS pr ON p.price_range_id = pr.range_id
                                                 JOIN property_category AS pc ON pc.pid = p.property_type_id
                                                 WHERE p.properties_id = ?', [$property_id]);
    
        // Fetch existing images for the property
        $data['property_images'] = DB::table('property_images')
                                      ->where('properties_id', $property_id)
                                      ->get();
    
        return view('property.editProperty', compact('data'));
    }
    public function updatePropertie(Request $request) {
        $propertie_id = $request->propertie_id;
    
        // Fetching old images and boucher
        $property = DB::table('properties')->where('properties_id', $propertie_id)->first();
        $old_image = $property->image;
        $old_boucher = $property->boucher;
    
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $property_image_name = substr(str_shuffle($permitted_chars), 0, 8);
    
        // Handle property image upload
        if ($request->hasFile('property_image')) {
            $property_image_name = substr(str_shuffle($permitted_chars), 0, 8) . time() . '.' . $request->property_image->extension();
            // Move the uploaded image to the public directory
            $request->property_image->move(public_path('property_photoes'), $property_image_name);
        } else {
            // Keep the old image if no new one is uploaded
            $property_image_name = $old_image;
        }
    
        // Handle property voucher upload
        $boucher_name = substr(str_shuffle($permitted_chars), 0, 8);
        if ($request->hasFile('property_voucher')) {
            $property_voucher = "property_bouchers/" . $boucher_name . time() . '.' . $request->property_voucher->extension();
            $request->property_voucher->move(public_path('property_bouchers'), $property_voucher);
        } else {
            // Keep the old boucher if no new one is uploaded
            $property_voucher = $old_boucher;
        }
    
        // Update property details in the database
        $updateProperty = [
            'title' => $request->property_title,
            'property_type_id' => $request->property_type_id,
            'builder_name' => $request->builder_name,
            's_price' => $request->s_price,
            'select_bhk' => $request->select_bhk,
            'property_details' => $request->property_description,
            'address' => $request->property_address,
            'email' => $request->email_id,
            'contact' => $request->contact_number,
            'price_range_id' => $request->price_range,
            'creator_id' => $request->creator_id,
            'image' => $property_image,
            'boucher' => $property_voucher,
            'facilities' => $request->amenities,
            'area' => $request->area,
            'builtup_area' => $request->builtup_area,
            'city' => $request->city,
            'rera' => $request->rera,
            'beds' => $request->beds,
            'baths' => $request->baths,
            'balconies' => $request->balconies,
            'parking' => $request->parking,
            'localities' => $request->localities,
            'location' => $request->location,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'land_type' => $request->land_type,
        ];
    
        try {
            // Activity logs
            $username = Session::get('username');
            $user_id = Session::get('user_id');
            $details = "Property Updated successfully by " . $username;
            app(UsersController::class)->insertActivityLogs($user_id, $details);
    
            // Update property information in the database
            DB::table('properties')->where('properties_id', $propertie_id)->update($updateProperty);
    
            // Handle multiple images update
            if ($request->hasFile('additional_images')) {
                foreach ($request->file('additional_images') as $image) {
                    $imageName = "property_photoes/" . time() . rand(1000, 9999) . '.' . $image->extension();
                    $image->move(public_path('property_photoes'), $imageName);
    
                    // Insert the new image record into the database
                    DB::table('property_images')->insert([
                        'properties_id' => $propertie_id,
                        'image_url' => $imageName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
    
            return response()->json(['status' => 1, 'msg' => 'Property information updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'msg' => 'Error updating property: ' . $e->getMessage()]);
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
                return response()->json(['status'=>1,'msg'=>'Propertie deleted successfully !']);
            }
        }catch (\Exception $e) {
            DB::rollback();            
            dd($e->getMessage());
        }
    }


}