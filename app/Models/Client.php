<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'link',
        'img',
        'alt',
        'isPartener',
    ];

    // public $timestamps = false;


    public function getImg()
    {
        if ($this->img && file_exists(public_path('storage/'.config('global.image_client').'/'.$this->img))) {
            $img = asset('storage/'.config('global.image_client').'/'.$this->img);
        } else {
            return 'Image not found';
        }

        return $img;
    }


    /**
     * toutes les image.
     */
    // public function getImgs()
    // {
    //     if ($this->img && file_exists(public_path('storage/'.config('global.image_client').'/'.$this->img))) {
    //         $img = asset('storage/'.config('global.image_client').'/'.$this->img);
    //     } else {
    //         return false;
    //         $img = asset(config('global.default_image_actuality'));
    //     }

    //     return $img;
    // }
}
