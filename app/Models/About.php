<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class About extends Model
{
    use HasFactory;

    protected $table = 'abouts';
    protected $fillable = [
        'description',
        'objectif',
        'img1',
        'img2',
        'doc',
    ];

    public function getImg1()
    {
        if ($this->img1 && file_exists(public_path('storage/'.config('global.image_about').'/'.$this->img1))) {
            $img1 = asset('storage/'.config('global.image_about').'/'.$this->img1);
        } else {
            return 'Image not found';
        }

        return $img1;
    }
    public function getImg2()
    {
        if ($this->img2 && file_exists(public_path('storage/'.config('global.image_about').'/'.$this->img2))) {
            $img2 = asset('storage/'.config('global.image_about').'/'.$this->img2);
        } else {
            return 'Image not found';
        }

        return $img2;
    }
    public function getDoc()
    {
        if ($this->doc && file_exists(public_path('storage/'.config('global.file_about').'/'.$this->doc))) {
            $doc = asset('storage/'.config('global.file_about').'/'.$this->doc);
        } else {
            return 'Document not found';
        }

        return $doc;
    }
    public function str_limit(string $text, int $nombre)
    {
        return Str::words($text, $nombre ,' ...');
    }
}
