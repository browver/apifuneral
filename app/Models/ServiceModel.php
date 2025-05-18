<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceModel extends Model
{
    protected $tasble = "service_models";
        protected $fillable =[
            'id',
            'name',
            'description',
            'price'
        ];
}
