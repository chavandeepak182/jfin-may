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
        return view('property.addProperty',compact('data'));
    }

    public function insertProperty(Request $request)
    {  
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        
        // Handle Property Image Upload
        $property_image_name = substr(str_shuffle($permitted_chars), 0, 8);
        if ($request->hasFile('property_image')) {
            $property_image = "property_photos/" . $property_image_name . time() . '.' . $request->property_image->extension();
            $request->property_image->move(public_path('property_photos'), $property_image);
        } else {
            $property_image = "";
        }
    
        // Handle Property Voucher Upload
        $boucher_name = substr(str_shuffle($permitted_chars), 0, 8);
        if ($request->hasFile('property_voucher')) {
            $property_voucher = "property_brochures/" . $boucher_name . time() . '.' . $request->property_voucher->extension();
            $request->property_voucher->move(public_path('property_brochures'), $property_voucher);
        } else {
            $property_voucher = "";
        }
    
        DB::beginTransaction();
    
        try {
            $p = new Property;
            $p->title = $request->property_title;
            $p->property_type_id = $request->property_type;
            $p->builder_name = $request->builder_name;
            $p->image = $property_image;
            $p->property_details = $request->property_description;
            $p->address = $request->property_address;
            
            // Handling Amenities (Checkboxes)
            $amenities = $request->input('amenities'); // Get selected amenities
            if ($amenities) {
                $p->facilities = implode(', ', $amenities); // Store as a comma-separated string
            } else {
                $p->facilities = ''; // No amenities selected
            }
    
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
            $p->boucher = $property_voucher;
            $p->location = $request->input('location'); 
            $p->latitude = $request->input('latitude'); 
            $p->longitude = $request->input('longitude');
            $nearby_locations = $request->input('nearby', []);
        
            // If there are any nearby locations, store them as JSON
            if (count($nearby_locations) > 0) {
                $p->nearby_locations = json_encode($nearby_locations);
            } else {
                $p->nearby_locations = json_encode([]);  // Store an empty array if no locations are provided
            }
        
            // Save property
            $p->save();
    
            // Activity logs (if needed)
            $username = Session::get('username');
            $user_id = Session::get('user_id');
            $details = $username . " has added a new property";
            
            // Commit transaction if successful
            DB::commit();
            return response()->json(['status' => 1, 'msg' => 'Property added successfully']);
    
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => 0, 'msg' => $e->getMessage()]);
        }
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

    public function viewDetails($property_id){    
        $data['propertie_details'] = DB::select('select * from properties as p, price_range as pr, property_category as pc where 
        p.price_range_id = pr.range_id and pc.pid = p.property_type_id and p.properties_id =' . $property_id);

        return view('property.propertyDetails',compact('data'));

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

    public function editProperty($property_id){    
        $data['range'] = DB::table('price_range')->get();
        $data['category'] = DB::table('property_category')->get();
        $data['propertie_details'] = DB::select('select * from properties as p, price_range as pr, property_category as pc where 
        p.price_range_id = pr.range_id and pc.pid = p.property_type_id and p.properties_id =' . $property_id);

        return view('property.editProperty',compact('data'));

    }

    public function updatePropertie(Request $request){
        $propertie_id = $request->propertie_id;

        //fetching old images and boucher
        $p = DB::table('properties')->where('properties_id', $propertie_id)->get();

        $p_image = $p[0]->image;
        $p_boucher = $p[0]->boucher;

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $property_image_name = substr(str_shuffle($permitted_chars), 0, 8);
        if ($request->hasFile('property_image')) {
            $property_image = "property_photoes/".$property_image_name.time().'.'.$request->property_image->extension();
            $request->property_image->move(public_path('property_photoes'), $property_image);
        } else {
            $property_image = $p_image;
        }

        $boucher_name = substr(str_shuffle($permitted_chars), 0, 8);
        if ($request->hasFile('property_voucher')) {
            $property_voucher = "property_bouchers/".$boucher_name.time().'.'.$request->property_voucher->extension();
            $request->property_voucher->move(public_path('property_bouchers'), $property_voucher);
        } else {
            $property_voucher = $p_boucher;
        }
        
        
        $updatePropertie = array(
            'title'=> $request->property_title,
            'property_type_id'=> $request->property_type_id,
            'builder_name'=> $request->builder_name,
            's_price'=>$request->s_price,
            'select_bhk'=> $request->select_bhk,
            'property_details'=> $request->property_description,
            'address'=> $request->property_address,
            'email'=> $request->email_id,
            'contact'=> $request->contact_number,
            'price_range_id'=> $request->price_range,
            'creator_id'=> $request->creator_id,
            'image'=> $property_image,
            'boucher'=> $property_voucher,
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
            'land_type' =>$request->land_type,
                
        );

        try{    

            //activity logs
            $username = Session::get('username');
            $user_id = Session::get('user_id');
            $details = "Property Updated successfully by ".$username; 
            app(UsersController::class)->insertActivityLogs($user_id, $details);
            //end of activity logs   
            
            $update_propertie = DB::table('properties')->where('properties_id',$propertie_id)->update($updatePropertie);
            return response()->json(['status'=>1,'msg'=>'Propertie information updated successfully !']);

        }catch (\Exception $e) {           
            return $e->getMessage();
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