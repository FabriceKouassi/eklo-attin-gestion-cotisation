<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;
    protected $table = 'solutions';
    protected $fillable = [
        'titre',
        'slug',
        'sousTitre',
        'img',
        'alt',
        'banniere',
        'isNav',
        'description',
        'doc',
    ];

    public function getImg()
    {
        if ($this->img && file_exists(public_path('storage/'.config('global.image_solution').'/'.$this->img))) {
            $img = asset('storage/'.config('global.image_solution').'/'.$this->img);
        } else {
            return 'Image not found';
        }

        return $img;
    }

    public function getFile()
    {
        if ($this->doc && file_exists(public_path('storage/'.config('global.file_solution').'/'.$this->doc))) {
            $file = asset('storage/'.config('global.file_solution').'/'.$this->doc);
        } else {
            return 'Document not found';
        }
        return $file;
    }

}
