<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CemeteryPlot;

class CemeteryController extends Controller
{
    // Create Cemetery Plot
    public function createCemetery(Request $request) {
        $request->validate([
            'id' => 'required',
            'plot_number' => 'required',
            'class_id' => 'required',
            'area_sqm' => 'required|numeric',
            'is_available' => 'required|boolean',
            'location' => 'required',
        ]);

        $cemetery = CemeteryPlot::create([
            'id' => $request->id,
            'plot_number' => $request->plot_number,
            'class_id' => $request->class_id,
            'area_sqm' => $request->area_sqm,
            'is_available' => $request->is_available,
            'location' => $request->location
        ]);

        return response([
            'message' => 'success',
            'cemetery' => $cemetery,
            'status' => 200
        ]);
    }

    // Get all cemetery plots
    public function getAllCemeteries() {
        $cemeteries = CemeteryPlot::with('plotClass')->get();

        if ($cemeteries->isEmpty()) {
            return response([
                'message' => 'error',
                'cemeteries' => 'No cemetery plots in database',
                'status' => 404
            ]);
        }

        return response([
            'message' => 'success',
            'cemeteries' => $cemeteries,
            'status' => 200
        ]);
    }

    // Get single cemetery plot
    public function getCemetery(Request $request) {
        $request->validate(['id' => 'required']);
        $cemetery = CemeteryPlot::with('plotClass')->find($request->id);

        if ($cemetery) {
            return response([
                'message' => 'success',
                'cemetery' => $cemetery,
                'status' => 200
            ]);
        } else {
            return response([
                'message' => 'error',
                'cemetery' => 'Cemetery plot not found',
                'status' => 404
            ]);
        }
    }

    // Update cemetery plot
    public function updateCemetery(Request $request) {
        $request->validate([
            'id' => 'required',
            'plot_number' => 'required',
            'class_id' => 'required',
            'area_sqm' => 'required|numeric',
            'is_available' => 'required|boolean',
            'location' => 'required',
        ]);

        $cemetery = CemeteryPlot::find($request->id);

        if ($cemetery) {
            $cemetery->plot_number = $request->plot_number;
            $cemetery->class_id = $request->class_id;
            $cemetery->area_sqm = $request->area_sqm;
            $cemetery->is_available = $request->is_available;
            $cemetery->location = $request->location;
            $cemetery->save();

            return response([
                'message' => 'Cemetery plot updated successfully',
                'cemetery' => $cemetery,
                'status' => 200
            ]);
        } else {
            return response([
                'message' => 'error',
                'cemetery' => 'Cemetery plot does not exist',
                'status' => 404
            ]);
        }
    }

    // Delete cemetery plot
    public function deleteCemetery(Request $request) {
        $request->validate(['id' => 'required']);
        $cemetery = CemeteryPlot::find($request->id);

        if ($cemetery) {
            $cemetery->delete();

            return response([
                'message' => 'success',
                'cemetery' => 'Cemetery plot deleted successfully',
                'status' => 200
            ]);
        } else {
            return response([
                'message' => 'error',
                'cemetery' => 'Cemetery plot does not exist',
                'status' => 404
            ]);
        }
    }
}
