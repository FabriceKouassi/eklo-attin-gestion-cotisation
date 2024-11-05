<?php

namespace App\Models\SecondDataBaseModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeCertificat extends Model
{
    use HasFactory;
    protected $connexion = 'second_mysql';
    protected $table = 'type_certificats';

    public function demandeCertificats(): HasMany
    {
        return $this->hasMany(DemandeCertificat::class, 'type_certificat_id');
    }
}
