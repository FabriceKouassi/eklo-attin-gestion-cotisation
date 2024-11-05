<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FlashInfo extends Model
{
    use HasFactory;

    protected $table = 'flash_infos';

    protected $fillable = [
        'content'
    ];

    public function limit_text(string $text)
    {
        return Str::limit($text, 30, ' ...');
    }
}
