<?php

namespace App\Models\SecondDataBaseModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Certificat extends Model
{
    use HasFactory;

    protected $connection = 'second_mysql';
    protected $table = 'certificats';

    protected $with = 'demandeCertificat';

    protected $fillable = [
        'demande_certificat_id'
    ];

    public function demandeCertificat(): BelongsTo
    {
        return $this->belongsTo(DemandeCertificat::class, 'demande_certificat_id');
    }
}
