<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\PlotModel;


class CemeteryPlot extends Model
{
    protected $table = "cemetery_models";
        protected $fillable =[
            'id',
            'plot_number',
            'class_id',
            'area_sqm',
            'is_available',
            'location',
        ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::id();
            }
        });
    }

    public function plotClass()
    {
        return $this->belongsTo(PlotModel::class, 'class_id');
    }
}
