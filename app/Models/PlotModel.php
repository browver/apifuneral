<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlotModel extends Model
{
    protected $tasble = "plot_models";
        protected $fillable =[
            'id',
            'name',
            'description',
            'price_per_sqm'
        ];
}
