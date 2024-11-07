<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Demande extends Model
{
    use HasFactory;
    protected $table = 'demandes';

    protected $with = ['demandeur', 'motif'];

    protected $fillable = [
        'demandeur_id',
        'motif_id',
        'description',
        'decision'
    ];

    public function demandeur():BelongsTo
    {
        return $this->belongsTo(User::class, 'demandeur_id');
    }

    public function motif():BelongsTo
    {
        return $this->belongsTo(Motif::class);
    }
}
