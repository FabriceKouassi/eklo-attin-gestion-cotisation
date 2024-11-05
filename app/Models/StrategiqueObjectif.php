<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class StrategiqueObjectif extends Model
{
    use HasFactory;
    protected $table = 'strategique_objectifs';
    protected $with = 'activites';

    protected $fillable = [
        'content',
        'axe_id'
    ];

    public function axe(): BelongsTo
    {
        return $this->belongsTo(StrategiqueAxe::class, 'axe_id');
    }

    public function activites(): HasMany
    {
        return $this->hasMany(StrategiqueActivite::class, 'objectif_id');
    }

    public function str_limit(string $text, int $nombre)
    {
        return Str::words($text, $nombre, '...');
    }
}
