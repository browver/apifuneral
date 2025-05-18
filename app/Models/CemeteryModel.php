<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CemeteryModel extends Model
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
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function plotClass()
    {
        return $this->belongsTo(PlotClass::class, 'class_id');
    }
}
