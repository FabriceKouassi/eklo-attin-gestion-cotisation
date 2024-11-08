<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CotisationMensuelle extends Model
{
    use HasFactory;
    protected $table = 'cotisation_mensuelles';

    protected $fillable = [
        'user_id',
        'gestionnaire_id',
        'mois',
        'annee',
        'date_paiement',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function gestionnaire(): BelongsTo
    {
        return $this->belongsTo(User::class, 'gestionnaire_id');
    }
}
