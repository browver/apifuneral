<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FuneralOrderController extends Controller
{
    function CreateFuneralOrder(Request $request){
        // Create FuneralOrder
        $request->validate([
            'id'=> 'required',
            'name'=> 'required',
            'description'=> 'required',
            'price'=> 'required',
        ]);

        $FuneralOrder = FuneralOrderModel::create([
            'id' => $request->id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]);

        return response(
                [
                    'message'=> 'success',
                    'FuneralOrder'=>[
                        'id' => $FuneralOrder->id,
                        'name' => $FuneralOrder->name,
                        'description' => $FuneralOrder->description,
                        'price' => 'Rp ' . number_format($FuneralOrder->price, 0, ',', '.')
                    ],
                    'status'=> 200
                ]
            );
         }


    // All Serivces
    function getAllFuneralOrders(){
        $FuneralOrders = FuneralOrderModel::all();
        if($FuneralOrders->isEmpty()){
            return response([
                'message'=>'error',
                'FuneralOrders'=>'No FuneralOrders in database'
            ]);
        }
        return response([
            'message' => 'success',
            'FuneralOrders' => $FuneralOrders,
            'status' => 200
        ]);
    }

    // Single FuneralOrder
    function getFuneralOrder(Request $request){
        $request-> validate(['id'=> 'required']);
        $FuneralOrder = FuneralOrderModel::find($request->id);
        if($FuneralOrder){
            return response([
                'message'=>'success',
                'FuneralOrder'=>$FuneralOrder,
                'status'=> 200
            ]);
        } else{
            return response([
                'message'=>'error',
                'FuneralOrder'=>'FuneralOrder not found',
                'status'=> 404
            ]);
        }
    }

    // update FuneralOrder
    function updateFuneralOrder(Request $request){
        $request -> validate([
            'id'=> 'required',
            'name'=> 'required',
            'description'=> 'required',
            'price'=> 'required',
        ]);

        $FuneralOrder = FuneralOrderModel::find($request->id);
        if($FuneralOrder){
            $FuneralOrder->name = $request->name;
            $FuneralOrder->description = $request->description;
            $FuneralOrder->price = $request->price;
            $FuneralOrder->save();
            return response([
                'message'=> 'FuneralOrder updated successfully',
                'FuneralOrder'=> $FuneralOrder,
                'status'=> 200
            ]);
        }else{
            return response([
                'message'=> 'error',
                'FuneralOrder'=> 'FuneralOrder doesn\'t exist',
                'status'=> 404

            ]);
        }
    }

    function deleteFuneralOrder(Request $request){
        $request->validate(['id' => 'required']);
        $FuneralOrder = FuneralOrderModel::find($request->id);
        if($FuneralOrder){
            $FuneralOrder->delete();
            return response([
                'message'=>'success',
                'FuneralOrder'=> 'FuneralOrder has been deleted successfully',
                'status'=> 200
            ]);
        }else{
            return response([
                'message'=>'error',
                'FuneralOrder'=> 'FuneralOrder does not exist',
                'status'=> 404
            ]);
        }
    }
}
