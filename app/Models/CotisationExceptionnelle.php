<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CotisationExceptionnelle extends Model
{
    use HasFactory;

    protected $table = 'cotisation_exceptionnelles';

    protected $fillable = [
        'demande_id',
        'contributeur_id',
        'montant',
        'gestionnaire_id', // User connecté
    ];

    public function demande(): BelongsTo
    {
        return $this->belongsTo(Demande::class);
    }

    public function contributeur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'contributeur_id');
    }

    public function gestionnaire(): BelongsTo
    {
        return $this->belongsTo(User::class, 'gestionnaire_id');
    }

}
