<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CotisationExceptionnelle extends Model
{
    use HasFactory;

    protected $table = 'cotisation_exceptionnelles';

    protected $fillable = [
        'contributeur_id',
        'beneficiaire_id',
        'motif_id', // Raison principale de la cotisation
        'montant',
        'gestionnaire_id', // User connecté
    ];

    public function motif():BelongsTo
    {
        return $this->belongsTo(Motif::class);
    }

    public function contributeurs():HasMany
    {
        return $this->hasMany(User::class, 'contributeur_id');
    }

    public function beneficiaires():HasMany
    {
        return $this->hasMany(User::class, 'beneficiaire_id');
    }

    public function gestionnaires():HasMany
    {
        return $this->hasMany(User::class, 'gestionnaire_id');
    }
}
