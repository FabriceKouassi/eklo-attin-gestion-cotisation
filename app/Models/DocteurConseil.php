<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DocteurConseil extends Model
{
    use HasFactory;

    protected $table = 'docteur_conseils';

    protected $fillable = [
        'nom',
        'fonction',
        'content',
        'img',
        'alt',
    ];

    public function getImg()
    {
        if ($this->img && file_exists(public_path('storage/'.config('global.image_docteur').'/'.$this->img))) {
            $img = asset('storage/'.config('global.image_docteur').'/'.$this->img);
        } else {
            $img = asset(config('global.default_image_logo'));
        }

        return $img;
    }

    public function str_limit(string $text, int $nombre)
    {
        return Str::words($text, $nombre ,' ...');
    }
}
