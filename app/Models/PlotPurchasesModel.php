<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CemeteryPlot;

class PlotPurchasesModel extends Model
{
    protected $table = 'plot_purchases';

    protected $fillable = [
        'user_id',
        'plot_id',
        'purchase_date',
        'total_price',
        'payment_status',
    ];

    public $timestamps = false;

    protected static function booted()
    {
        static::creating(function ($purchase) {
            $plot = CemeteryPlot::with('plotClass')->find($purchase->plot_id);
            if ($plot && $plot->plotClass) {
                $purchase->total_price = $plot->area_sqm * $plot->plotClass->price_per_sqm;
            }
            else {
                throw new \Exception("Plot atau class tidak ditemukan untuk plot_id: {$purchase->plot_id}");
            }
        });
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Plot (CemeteryPlot)
    public function plot()
    {
        return $this->belongsTo(CemeteryPlot::class, 'plot_id');
    }
}