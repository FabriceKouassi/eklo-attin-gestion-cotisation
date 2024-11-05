<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class StrategiqueActivite extends Model
{
    use HasFactory;
    protected $table = 'strategique_activites';
    protected $fillable = [
        'content',
        'axe_id',
        'objectif_id'
    ];

    public function objectif(): BelongsTo
    {
        return $this->belongsTo(StrategiqueAxe::class, 'objectif_id');
    }

    public function str_limit(string $text, int $nombre)
    {
        return Str::words($text, $nombre, '...');
    }
}
