<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slogan',
        'adress',
        'phone1',
        'phone2',
        'phone3',
        'email1',
        'email2',
        'email3',
        'logo1',
        'logo2',
        'alt',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'youtube',
        'vision',
    ];

    /**
     * Get logo.
    */
    public function getLogo1()
    {
        if ($this->logo1 && file_exists(public_path('storage/'.config('global.image_logo').'/'.$this->logo1))) {
            $logo1 = asset('storage/'.config('global.image_logo').'/'.$this->logo1);
        } else {
            $logo1 = asset(config('global.default_image_logo'));
        }

        return $logo1;
    }
    public function getLogo2()
    {
        if ($this->logo2 && file_exists(public_path('storage/'.config('global.image_logo').'/'.$this->logo2))) {
            $logo2 = asset('storage/'.config('global.image_logo').'/'.$this->logo2);
        } else {
            $logo2 = asset(config('global.default_image_logo2'));
        }

        return $logo2;
    }

}
