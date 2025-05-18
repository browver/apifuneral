<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaintenanceModel;


class MaintenanceController extends Controller
{
    function CreateMaintenance(Request $request){
        // Create Maintenance
        $request->validate([
            'id'=> 'required',
            'name'=> 'required',
            'description'=> 'required',
            'price'=> 'required',
        ]);

        $Maintenance = MaintenanceModel::create([
            'id' => $request->id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]);

        return response(
                [
                    'message'=> 'success',
                    'Maintenance'=>[
                        'id' => $Maintenance->id,
                        'name' => $Maintenance->name,
                        'description' => $Maintenance->description,
                        'price' => 'Rp ' . number_format($Maintenance->price, 0, ',', '.')
                    ],
                    'status'=> 200
                ]
            );
         }


    // All Serivces
    function getAllMaintenances(){
        $Maintenances = MaintenanceModel::all();
        if($Maintenances->isEmpty()){
            return response([
                'message'=>'error',
                'Maintenances'=>'No Maintenances in database'
            ]);
        }
        return response([
            'message' => 'success',
            'Maintenances' => $Maintenances,
            'status' => 200
        ]);
    }

    // Single Maintenance
    function getMaintenance(Request $request){
        $request-> validate(['id'=> 'required']);
        $Maintenance = MaintenanceModel::find($request->id);
        if($Maintenance){
            return response([
                'message'=>'success',
                'Maintenance'=>$Maintenance,
                'status'=> 200
            ]);
        } else{
            return response([
                'message'=>'error',
                'Maintenance'=>'Maintenance not found',
                'status'=> 404
            ]);
        }
    }

    // update Maintenance
    function updateMaintenance(Request $request){
        $request -> validate([
            'id'=> 'required',
            'name'=> 'required',
            'description'=> 'required',
            'price'=> 'required',
        ]);

        $Maintenance = MaintenanceModel::find($request->id);
        if($Maintenance){
            $Maintenance->name = $request->name;
            $Maintenance->description = $request->description;
            $Maintenance->price = $request->price;
            $Maintenance->save();
            return response([
                'message'=> 'Maintenance updated successfully',
                'Maintenance'=> $Maintenance,
                'status'=> 200
            ]);
        }else{
            return response([
                'message'=> 'error',
                'Maintenance'=> 'Maintenance doesn\'t exist',
                'status'=> 404

            ]);
        }
    }

    function deleteMaintenance(Request $request){
        $request->validate(['id' => 'required']);
        $Maintenance = MaintenanceModel::find($request->id);
        if($Maintenance){
            $Maintenance->delete();
            return response([
                'message'=>'success',
                'Maintenance'=> 'Maintenance has been deleted successfully',
                'status'=> 200
            ]);
        }else{
            return response([
                'message'=>'error',
                'Maintenance'=> 'Maintenance does not exist',
                'status'=> 404
            ]);
        }
    }
}
