<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CemeteryModel;

class CemeteryController extends Controller
{
    public function CreateCemetery(Request $request)
    {
        $request->validate([
            'id' => 'required|uuid',
            'plot_number' => 'required|string|unique:cemetery_models',
            'class_id' => 'required|uuid',
            'area_sqm' => 'required|numeric',
            'is_available' => 'required|boolean',
            'location' => 'required|string',
        ]);

        // Create Cemetery

        $cemetery = CemeteryModel::create([
            'id' => $request->id,
            'plot_number' => $request->plot_number,
            'class_id' => $request->class_id,
            'area_sqm' => $request->area_sqm,
            'is_available' => $request->is_available,
            'location' => $request->location,
        ]);

        return response([
            'message' => 'success',
            'cemetery' => $cemetery,
            'status' => 200
        ]);
    }

    // All Cemeteries

    public function getAllCemeteries()
    {
        $cemeteries = CemeteryModel::all();
        if ($cemeteries->isEmpty()) {
            return response([
                'message' => 'error',
                'cemeteries' => 'No cemetery data found',
                'status' => 404
            ]);
        }

        return response([
            'message' => 'success',
            'cemeteries' => $cemeteries,
            'status' => 200
        ]);
    }

    // Single Cemetery
    public function getCemetery(Request $request)
    {
        $request->validate(['id' => 'required|uuid']);
        $cemetery = CemeteryModel::find($request->id);

        if ($cemetery) {
            return response([
                'message' => 'success',
                'cemetery' => $cemetery,
                'status' => 200
            ]);
        } else {
            return response([
                'message' => 'error',
                'cemetery' => 'Cemetery not found',
                'status' => 404
            ]);
        }
    }

    // Update Cemetery
    public function updateCemetery(Request $request)
    {
        $request->validate([
            'id' => 'required|uuid',
            'plot_number' => 'required|string',
            'class_id' => 'required|uuid',
            'area_sqm' => 'required|numeric',
            'is_available' => 'required|boolean',
            'location' => 'required|string',
        ]);

        $cemetery = CemeteryModel::find($request->id);
        if ($cemetery) {
            $cemetery->plot_number = $request->plot_number;
            $cemetery->class_id = $request->class_id;
            $cemetery->area_sqm = $request->area_sqm;
            $cemetery->is_available = $request->is_available;
            $cemetery->location = $request->location;
            $cemetery->save();

            return response([
                'message' => 'Cemetery updated successfully',
                'cemetery' => $cemetery,
                'status' => 200
            ]);
        } else {
            return response([
                'message' => 'error',
                'cemetery' => 'Cemetery not found',
                'status' => 404
            ]);
        }
    }

    // Delete Cemetery
    public function deleteCemetery(Request $request)
    {
        $request->validate(['id' => 'required|uuid']);
        $cemetery = CemeteryModel::find($request->id);

        if ($cemetery) {
            $cemetery->delete();
            return response([
                'message' => 'success',
                'cemetery' => 'Cemetery deleted successfully',
                'status' => 200
            ]);
        } else {
            return response([
                'message' => 'error',
                'cemetery' => 'Cemetery not found',
                'status' => 404
            ]);
        }
    }
}
