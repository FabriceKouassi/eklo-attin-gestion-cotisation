<?php

namespace App\Models\SecondDataBaseModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EtablissementType extends Model
{
    use HasFactory;

    protected $connection = 'second_mysql';
    protected $table = 'certificats';

    public function etablissements(): HasMany
    {
        return $this->hasMany(Etablissement::class, 'type_etablissement_id');
    }
}
