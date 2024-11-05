<?php

namespace App\Models\SecondDataBaseModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Etablissement extends Model
{
    use HasFactory;
    protected $connexion = 'second_mysql';
    protected $table = 'etablissements';

    protected $with = ['etablissementType'];

    protected $fillable = [
        'type_etablissement_id'
    ];

    public function etablissementType(): BelongsTo
    {
        return $this->belongsTo(EtablissementType::class, 'type_etablissement_id');
    }
}
