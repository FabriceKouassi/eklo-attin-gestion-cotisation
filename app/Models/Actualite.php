<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Actualite extends Model
{
    use HasFactory;

    protected $table = 'actualites';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'img',
        'img_alt',
        'doc',
        'doc_alt',
    ];

    public function getImg()
    {
        if ($this->img && file_exists(public_path('storage/'.config('global.image_actualite').'/'.$this->img))) {
            $img = asset('storage/'.config('global.image_actualite').'/'.$this->img);
        } else {
            $img = asset(config('global.default_image_logo'));
        }

        return $img;
    }

    public function getDoc()
    {
        if ($this->doc && file_exists(public_path('storage/'.config('global.file_actualite').'/'.$this->doc))) {
            $doc = asset('storage/'.config('global.file_actualite').'/'.$this->doc);
        } else {
            $doc = asset(config('global.default_image_logo2'));
        }

        return $doc;
    }

    public function str_limit(string $text, int $nombre)
    {
        return Str::words($text, $nombre ,' ...');
    }
}
