<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VaccinFamille extends Model
{
    use HasFactory;
    protected $table = 'vaccin_familles';
    protected $fillable = [
        'libelle',
    ];

    public function  vaccinsDisponibles(): HasMany
    {
        return $this->hasMany(VaccinDisponible::class, 'vaccin_famille_id');
    }

    public function  vaccinationCalendriers(): HasMany
    {
        return $this->hasMany(VaccinationCalendrier::class, 'vaccin_famille_id');
    }
}
