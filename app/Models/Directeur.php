<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directeur extends Model
{
    use HasFactory;

    protected $table = 'directeurs';
    protected $fillable = [
        'nom',
        'img',
        'doc',
        'alt',
        'content'
    ];

    public function getImg()
    {
        if ($this->img && file_exists(public_path('storage/'.config('global.image_directeur').'/'.$this->img))) {
            $img = asset('storage/'.config('global.image_directeur').'/'.$this->img);
        } else {
            $img = asset(config('global.default_image_logo'));
        }

        return $img;
    }

    public function getDoc()
    {
        if ($this->doc && file_exists(public_path('storage/'.config('global.file_directeur').'/'.$this->doc))) {
            $doc = asset('storage/'.config('global.file_directeur').'/'.$this->doc);
        } else {
            $doc = asset(config('global.default_image_logo2'));
        }

        return $doc;
    }
}
