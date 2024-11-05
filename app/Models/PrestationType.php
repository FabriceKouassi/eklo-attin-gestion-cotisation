<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PrestationType extends Model
{
    use HasFactory;

    protected $table = 'prestation_types';

    protected $fillable = [
        'libelle',
        'slug',
        'description',
        'isNav',
        'img'
    ];

    public function  prestations(): HasMany
    {
       return $this->hasMany(Prestation::class, 'prestation_types_id');
    }

    public function getImg()
    {
        if ($this->img && file_exists(public_path('storage/'.config('global.image_prestationType').'/'.$this->img))) {
            $img = asset('storage/'.config('global.image_prestationType').'/'.$this->img);
        } else {
            return asset('model/assets/icons/icon-categorie.svg');
        }

        return $img;
    }
}
