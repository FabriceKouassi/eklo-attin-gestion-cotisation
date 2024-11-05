<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VaccinationCalendrier extends Model
{
    use HasFactory;
    protected $table = 'vaccination_calendriers';
    protected $with = ['vaccinFamille'];
    
    protected $fillable = [
        'nom',
        'age',
        'title',
        'periode',
        'cout',
        'frequence',
        'vaccin_famille_id',
    ];

    public function vaccinFamille(): BelongsTo
    {
        return $this->belongsTo(VaccinFamille::class, 'vaccin_famille_id');
    }
}
