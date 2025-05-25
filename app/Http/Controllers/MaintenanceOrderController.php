<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaintenanceOrderController extends Controller
{
    function CreateMaintenanceOrder(Request $request){
        // Create MaintenanceOrder
        $request->validate([
            'id'=> 'required',
            'name'=> 'required',
            'description'=> 'required',
            'price'=> 'required',
        ]);

        $MaintenanceOrder = MaintenanceOrderModel::create([
            'id' => $request->id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]);

        return response(
                [
                    'message'=> 'success',
                    'MaintenanceOrder'=>[
                        'id' => $MaintenanceOrder->id,
                        'name' => $MaintenanceOrder->name,
                        'description' => $MaintenanceOrder->description,
                        'price' => 'Rp ' . number_format($MaintenanceOrder->price, 0, ',', '.')
                    ],
                    'status'=> 200
                ]
            );
         }


    // All Serivces
    function getAllMaintenanceOrders(){
        $MaintenanceOrders = MaintenanceOrderModel::all();
        if($MaintenanceOrders->isEmpty()){
            return response([
                'message'=>'error',
                'MaintenanceOrders'=>'No MaintenanceOrders in database'
            ]);
        }
        return response([
            'message' => 'success',
            'MaintenanceOrders' => $MaintenanceOrders,
            'status' => 200
        ]);
    }

    // Single MaintenanceOrder
    function getMaintenanceOrder(Request $request){
        $request-> validate(['id'=> 'required']);
        $MaintenanceOrder = MaintenanceOrderModel::find($request->id);
        if($MaintenanceOrder){
            return response([
                'message'=>'success',
                'MaintenanceOrder'=>$MaintenanceOrder,
                'status'=> 200
            ]);
        } else{
            return response([
                'message'=>'error',
                'MaintenanceOrder'=>'MaintenanceOrder not found',
                'status'=> 404
            ]);
        }
    }

    // update MaintenanceOrder
    function updateMaintenanceOrder(Request $request){
        $request -> validate([
            'id'=> 'required',
            'name'=> 'required',
            'description'=> 'required',
            'price'=> 'required',
        ]);

        $MaintenanceOrder = MaintenanceOrderModel::find($request->id);
        if($MaintenanceOrder){
            $MaintenanceOrder->name = $request->name;
            $MaintenanceOrder->description = $request->description;
            $MaintenanceOrder->price = $request->price;
            $MaintenanceOrder->save();
            return response([
                'message'=> 'MaintenanceOrder updated successfully',
                'MaintenanceOrder'=> $MaintenanceOrder,
                'status'=> 200
            ]);
        }else{
            return response([
                'message'=> 'error',
                'MaintenanceOrder'=> 'MaintenanceOrder doesn\'t exist',
                'status'=> 404

            ]);
        }
    }

    function deleteMaintenanceOrder(Request $request){
        $request->validate(['id' => 'required']);
        $MaintenanceOrder = MaintenanceOrderModel::find($request->id);
        if($MaintenanceOrder){
            $MaintenanceOrder->delete();
            return response([
                'message'=>'success',
                'MaintenanceOrder'=> 'MaintenanceOrder has been deleted successfully',
                'status'=> 200
            ]);
        }else{
            return response([
                'message'=>'error',
                'MaintenanceOrder'=> 'MaintenanceOrder does not exist',
                'status'=> 404
            ]);
        }
    }
}

