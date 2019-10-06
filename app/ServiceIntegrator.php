<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceIntegrator extends Model
{
    protected $table = 'service_integrators';

    protected $fillable = [
    	'username', 'x_lsbu_key', 'is_active'
    ];
}
