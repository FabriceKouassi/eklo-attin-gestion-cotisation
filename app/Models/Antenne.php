<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Antenne extends Model
{
    use HasFactory;

    protected $table = 'antennes';

    protected $fillable = [
        'nom',
        'slug',
        'phone',
        'email',
        'adresse',
        'map',
    ];

    public function str_limit(?string $text, int $nombre)
    {
        return Str::words($text, $nombre ,' ...');
    }
}
