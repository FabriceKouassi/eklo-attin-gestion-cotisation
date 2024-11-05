<?php

namespace App\Models\SecondDataBaseModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DemandeCertificat extends Model
{
    use HasFactory;

    protected $connexion = 'second_mysql';
    protected $table = 'demande_certificats';

    protected $with = ['typeCertificat', 'etablissement'];

    protected $fillable = [
        'type_certificat_id',
        'etablissement_id'
    ];

    public function certificats(): HasMany
    {
        return $this->hasMany(Certificat::class, 'demande_certificat_id');
    }
    public function typeCertificat(): BelongsTo
    {
        return $this->belongsTo(TypeCertificat::class, 'type_certificat_id');
    }
    public function etablissement(): BelongsTo
    {
        return $this->belongsTo(Etablissement::class, 'etablissement_id');
    }

}
