<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlotModel;

class PlotController extends Controller
{
    // Create Plot
    public function createPlot(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price_per_sqm' => 'required|numeric|min:0',
        ]);

        $plot = PlotModel::create([
            'name' => $request->name,
            'description' => $request->description,
            'price_per_sqm' => $request->price_per_sqm,
        ]);

        return response([
            'message' => 'success',
            'plot' => [
                'id' => $plot->id,
                'name' => $plot->name,
                'description' => $plot->description,
                'price_per_sqm' => 'Rp ' . number_format($plot->price_per_sqm, 0, ',', '.'),
            ],
            'status' => 200,
        ]);
    }

    // Get All Plots
    public function getAllPlots()
    {
        $plots = PlotModel::all();

        if ($plots->isEmpty()) {
            return response([
                'message' => 'error',
                'plots' => 'No plots in database',
                'status' => 404,
            ]);
        }

        // Format price for all plots
        $formattedPlots = $plots->map(function ($plot) {
            return [
                'id' => $plot->id,
                'name' => $plot->name,
                'description' => $plot->description,
                'price_per_sqm' => 'Rp ' . number_format($plot->price_per_sqm, 0, ',', '.'),
            ];
        });

        return response([
            'message' => 'success',
            'plots' => $formattedPlots,
            'status' => 200,
        ]);
    }

    // Get Single Plot
    public function getPlot(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        $plot = PlotModel::find($request->id);

        if ($plot) {
            return response([
                'message' => 'success',
                'plot' => [
                    'id' => $plot->id,
                    'name' => $plot->name,
                    'description' => $plot->description,
                    'price_per_sqm' => 'Rp ' . number_format($plot->price_per_sqm, 0, ',', '.'),
                ],
                'status' => 200,
            ]);
        }

        return response([
            'message' => 'error',
            'plot' => 'Plot not found',
            'status' => 404,
        ]);
    }

    // Update Plot
    public function updatePlot(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required',
            'description' => 'required',
            'price_per_sqm' => 'required|numeric|min:0',
        ]);

        $plot = PlotModel::find($request->id);

        if ($plot) {
            $plot->update([
                'name' => $request->name,
                'description' => $request->description,
                'price_per_sqm' => $request->price_per_sqm,
            ]);

            return response([
                'message' => 'Plot updated successfully',
                'plot' => [
                    'id' => $plot->id,
                    'name' => $plot->name,
                    'description' => $plot->description,
                    'price_per_sqm' => 'Rp ' . number_format($plot->price_per_sqm, 0, ',', '.'),
                ],
                'status' => 200,
            ]);
        }

        return response([
            'message' => 'error',
            'plot' => 'Plot doesn\'t exist',
            'status' => 404,
        ]);
    }

    // Delete Plot
    public function deletePlot(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        $plot = PlotModel::find($request->id);

        if ($plot) {
            $plot->delete();

            return response([
                'message' => 'success',
                'plot' => 'Plot has been deleted successfully',
                'status' => 200,
            ]);
        }

        return response([
            'message' => 'error',
            'plot' => 'Plot does not exist',
            'status' => 404,
        ]);
    }
}
