<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceIntegrator extends Model
{
    protected $table = 'service_integrators';

    protected $fillable = [
    	'token', 'expired', 'is_active'
    ];

}
