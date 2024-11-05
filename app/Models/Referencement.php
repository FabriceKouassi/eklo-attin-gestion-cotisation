<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referencement extends Model
{
    use HasFactory;

    protected $table = 'referencements';

    protected $fillable = [
        'pageCible',
        'title',
        'meta_keywords',
        'meta_description',
        'meta_robots',
        'meta_category',
        'meta_identifier_url',
        'meta_reply_to',
    ];
}
