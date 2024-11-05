<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mediatheque extends Model
{
    use HasFactory;

    protected $table = 'mediatheques';

    protected $fillable = [
        'title',
        'content',
        'imgs'
    ];

    public function getImgs(): array
    {
        $images = json_decode($this->imgs);

        if ($images) {

            foreach ($images as $image) {
                $_image[] = asset('storage/'.config('global.image_mediatheque').'/'. $image);
            }

            return $_image;
        } else {
            return [];
        }
    }

    public function getImgsHomePage(int $nombre): array
    {
        $images = array_slice(json_decode($this->imgs), 0, $nombre);

        if ($images) {

            foreach ($images as $image) {
                $_image[] = asset('storage/'.config('global.image_mediatheque').'/'. $image);
            }

            return $_image;
        } else {
            return [];
        }
    }
}
