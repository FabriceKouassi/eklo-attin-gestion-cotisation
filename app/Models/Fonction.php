<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fonction extends Model
{
    use HasFactory;

    protected $table = 'fonctions';
    protected $with = ['users'];
    
    protected $fillable = [
        'libelle',
        'montant',
    ];

    public function users():HasMany
    {
        return $this->hasMany(User::class);
    }
}
