<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceModel extends Model
{
    protected $tasble = "maintenance_models";
        protected $fillable =[
            'id',
            'name',
            'description',
            'price'
        ];
}
