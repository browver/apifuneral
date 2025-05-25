<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuneralOrderModel extends Model
{
    use HasFactory;

    protected $table = 'funeral_orders';

    protected $fillable = [
        'user_id',
        'plot_id',
        'service_id',
        'order_date',
        'status',
    ];

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

    // Relasi ke FuneralService
    public function service()
    {
        return $this->belongsTo(FuneralService::class, 'service_id');
    }
}