<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceModel;

class ServiceController extends Controller
{
    function CreateService(Request $request){
        // Create Service
        $request->validate([
            'id'=> 'required',
            'name'=> 'required',
            'description'=> 'required',
            'price'=> 'required',
        ]);

        if (ServiceModel::find($request->id)) {
            return response([
                'message' => 'error',
                'service' => 'Service ID already exists',
                'status' => 409
            ]);
        }

        $service = ServiceModel::create([
            'id' => $request->id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]);

        if (!$service) {
            return response([
                'message' => 'error',
                'service' => 'Failed to create service',
                'status' => 500
            ]);
        }

        return response([
            'message'=> 'success',
            'service'=> [
                'id' => $service->id,
                'name' => $service->name,
                'description' => $service->description,
                'price' => 'Rp.' . number_format($service->price, 0, ',', '.')
            ],
            'status'=> 200
        ]);
    }

    // All Serivces
    function getAllServices(){
        $services = ServiceModel::all();
        if($services){
            return response([
                'message'=> 'Success',
                'services'=> $services
            ]);
        } else{
            return response([
                'message'=>'error',
                'services'=>'No Services in database'
            ]);
        }
    }

    // Single Service
    function getService(Request $request){
        $request-> validate(['id'=> 'required']);
        $service = ServiceModel::find($request->id);
        if($service){
            return response([
                'message'=>'success',
                'service'=>$service,
                'status'=> 200
            ]);
        } else{
            return response([
                'message'=>'error',
                'service'=>'Service not found',
                'status'=> 404
            ]);
        }
    }

    // update service
    function updateService(Request $request){
        $request -> validate([
            'id'=> 'required',
            'name'=> 'required',
            'description'=> 'required',
            'price'=> 'required',
        ]);

        $service = ServiceModel::find($request->id);
        if($service){
            $service->id = $request->id;
            $service->name = $request->name;
            $service->description = $request->description;
            $service->price = $request->price;
            $service->save();
            return response([
                'message'=> 'service updated successfully',
                'service'=> $service,
                'status'=> 200
            ]);
        }else{
            return response([
                'message'=> 'error',
                'service'=> 'Service doesn\'t exist',
                'status'=> 404

            ]);
        }
    }

    function deleteService(Request $request){
        $request->validate(['id' => 'required']);
        $service = ServiceModel::find($request->id);
        if($service){
            $service->delete();
            return response([
                'message'=>'success',
                'service'=> 'Service has been deleted successfully',
                'status'=> 200
            ]);
        }else{
            return response([
                'message'=>'error',
                'service'=> 'Service does not exist',
                'status'=> 404
            ]);
        }
    }
}
