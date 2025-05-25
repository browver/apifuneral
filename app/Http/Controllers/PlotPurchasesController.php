<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlotPurchasesModel;

class PlotPurchasesController extends Controller
{
    // Create Plot Purchase
    public function create(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'plot_id' => 'required|integer',
            'purchase_date' => 'required|date',
            'payment_status' => 'required|string',
        ]);

        $purchase = PlotPurchasesModel::create([
            'user_id' => $request->user_id,
            'plot_id' => $request->plot_id,
            'purchase_date' => $request->purchase_date,
            'payment_status' => $request->payment_status,
            // total_price akan dihitung otomatis di model booted()
        ]);

        return response([
            'message' => 'Success',
            'data' => $purchase,
            'status' => 201
        ]);
    }

    // Get All Plot Purchases
    public function getAll()
    {
        $purchases = PlotPurchasesModel::with(['user', 'plot.plotClass'])->get();

        if ($purchases->isEmpty()) {
            return response([
                'message' => 'No plot purchases found.',
                'status' => 404
            ]);
        }

        return response([
            'message' => 'Success',
            'data' => $purchases,
            'status' => 200
        ]);
    }

    // Get Single Plot Purchase
    public function getOne($id)
    {
        $purchase = PlotPurchasesModel::with(['user', 'plot.plotClass'])->find($id);

        if (!$purchase) {
            return response([
                'message' => 'Plot purchase not found.',
                'status' => 404
            ]);
        }

        return response([
            'message' => 'Success',
            'data' => $purchase,
            'status' => 200
        ]);
    }

    // Update Plot Purchase
    public function update(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required|string',
        ]);

        $purchase = PlotPurchasesModel::find($id);
        if (!$purchase) {
            return response([
                'message' => 'Plot purchase not found.',
                'status' => 404
            ]);
        }

        $purchase->payment_status = $request->payment_status;
        $purchase->save();

        return response([
            'message' => 'Plot purchase updated.',
            'data' => $purchase,
            'status' => 200
        ]);
    }

    // Delete Plot Purchase
    public function delete($id)
    {
        $purchase = PlotPurchasesModel::find($id);

        if (!$purchase) {
            return response([
                'message' => 'Plot purchase not found.',
                'status' => 404
            ]);
        }

        $purchase->delete();

        return response([
            'message' => 'Plot purchase deleted successfully.',
            'status' => 200
        ]);
    }
}
