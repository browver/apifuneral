<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlotModel;


class PlotController extends Controller
{
    function CreatePlot(Request $request){
        // Create Plot
        $request->validate([
            'id'=> 'required',
            'name'=> 'required',
            'description'=> 'required',
            'price_per_sqm'=> 'required',
        ]);

        $plot = PlotModel::create([
            'id' => $request->id,
            'name' => $request->name,
            'description' => $request->description,
            'price_per_sqm' => $request->price_per_sqm
        ]);

        return response(
                [
                    'message'=> 'success',
                    'plot'=>[
                        'id' => $plot->id,
                        'name' => $plot->name,
                        'description' => $plot->description,
                        'price_per_sqm' => 'Rp ' . number_format($plot->price_per_sqm, 0, ',', '.')
                    ],
                    'status'=> 200
                ]
            );
         }


    // All Serivces
    function getAllPlots(){
        $plots = PlotModel::all();
        if($plots->isEmpty()){
            return response([
                'message'=>'error',
                'plots'=>'No Plots in database'
            ]);
        }
        return response([
            'message' => 'success',
            'plots' => $plots,
            'status' => 200
        ]);
    }

    // Single Plot
    function getPlot(Request $request){
        $request-> validate(['id'=> 'required']);
        $plot = PlotModel::find($request->id);
        if($plot){
            return response([
                'message'=>'success',
                'plot'=>$plot,
                'status'=> 200
            ]);
        } else{
            return response([
                'message'=>'error',
                'plot'=>'Plot not found',
                'status'=> 404
            ]);
        }
    }

    // update Plot
    function updatePlot(Request $request){
        $request -> validate([
            'id'=> 'required',
            'name'=> 'required',
            'description'=> 'required',
            'price_per_sqm'=> 'required',
        ]);

        $plot = PlotModel::find($request->id);
        if($plot){
            $plot->name = $request->name;
            $plot->description = $request->description;
            $plot->price_per_sqm = $request->price_per_sqm;
            $plot->save();
            return response([
                'message'=> 'Plot updated successfully',
                'plot'=> $plot,
                'status'=> 200
            ]);
        }else{
            return response([
                'message'=> 'error',
                'plot'=> 'Plot doesn\'t exist',
                'status'=> 404

            ]);
        }
    }

    function deletePlot(Request $request){
        $request->validate(['id' => 'required']);
        $plot = PlotModel::find($request->id);
        if($plot){
            $plot->delete();
            return response([
                'message'=>'success',
                'plot'=> 'Plot has been deleted successfully',
                'status'=> 200
            ]);
        }else{
            return response([
                'message'=>'error',
                'plot'=> 'Plot does not exist',
                'status'=> 404
            ]);
        }
    }
}