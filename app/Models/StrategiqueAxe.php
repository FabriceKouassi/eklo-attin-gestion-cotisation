<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StrategiqueAxe extends Model
{
    use HasFactory;
    protected $table = 'strategique_axes';
    protected $with = 'objectifs';
    protected $fillable = [
        'libelle'
    ];

    public function objectifs(): HasMany
    {
        return $this->hasMany(StrategiqueObjectif::class, 'axe_id');
    }

}
