<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LaboratoireType extends Model
{
    use HasFactory;

    protected $table = 'laboratoire_types';
    protected $with = 'laboratoires';

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'icon',
    ];

    public function getIcon()
    {
        if ($this->icon && file_exists(public_path('storage/'.config('global.icon_laboratoire').'/'.$this->icon))) {
            $icon = asset('storage/'.config('global.icon_laboratoire').'/'.$this->icon);
        } else {
            return 'Image not found';
        }

        return $icon;
    }

    public function getDoc()
    {
        if ($this->doc && file_exists(public_path('storage/'.config('global.file_laboratoireType').'/'.$this->doc))) {
            $doc = asset('storage/'.config('global.file_laboratoireType').'/'.$this->doc);
        } else {
            return 'Document not found';
        }

        return $doc;
    }

    public function laboratoires(): HasMany
    {
        return $this->hasMany(Laboratoire::class, 'laboratoire_types_id');
    }
}
