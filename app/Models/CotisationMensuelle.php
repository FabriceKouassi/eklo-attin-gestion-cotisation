<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotisationMensuelle extends Model
{
    use HasFactory;
    protected $table = 'cotisation_mensuelles';
    protected $fillable = [
        'user_id',
        'nombre_mois'
    ];
}
