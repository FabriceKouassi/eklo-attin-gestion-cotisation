<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'slides';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text',
        'img',
        'alt',
        'enabled',
    ];

    /**
     * Get image.
     */
    public function getImg()
    {
        if ($this->img && file_exists(public_path('storage/'.config('global.image_slide').'/'.$this->img))) {
            $img = asset('storage/'.config('global.image_slide').'/'.$this->img);

        } else {
            //return false;
            $img = asset('storage/'.config('global.default_image_slide'));
        }

        return $img;
    }

    /**
     * Média
     *
     * @return void
     */
}
