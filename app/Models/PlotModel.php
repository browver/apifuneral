<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlotModel extends Model
{
    protected $table = "plot_models";
        protected $fillable =[
            'name',
            'description',
            'price_per_sqm'
        ];
}
