<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Motif extends Model
{
    use HasFactory;
    protected $table = 'motifs';

    protected $fillable = [
        'libelle'
    ];

    public function demandes():HasMany
    {
        return $this->hasMany(Demande::class);
    }

}
