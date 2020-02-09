<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsesorPermohonan extends Model
{
    protected $table = 'asesor_permohonan';

    protected $fillable = ['type', 'uid_permohonan', 'uid_asesor', 'uid_permohonan_asesor'];

    protected $primaryKey = 'uid_permohonan_asesor';
}
