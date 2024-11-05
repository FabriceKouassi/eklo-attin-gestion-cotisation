<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agendas';
    protected $fillable = [
        'title',
        'slug',
        'content',
        'location',
        'eventDate',
        'eventHour',
        'img',
        'doc',
    ];

    public function getImg()
    {
        if ($this->img && file_exists(public_path('storage/'.config('global.image_agenda').'/'.$this->img))) {
            $img = asset('storage/'.config('global.image_agenda').'/'.$this->img);
        } else {
            $img = asset(config('global.default_image_logo'));
        }

        return $img;
    }

    public function getDoc()
    {
        if ($this->doc && file_exists(public_path('storage/'.config('global.file_agenda').'/'.$this->doc))) {
            $doc = asset('storage/'.config('global.file_agenda').'/'.$this->doc);
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
