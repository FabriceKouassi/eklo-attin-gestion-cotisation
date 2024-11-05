<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prestation extends Model
{
    use HasFactory;

    protected $table = 'prestations';

    protected $with = ['prestationType'];

    protected $fillable = [
        'libelle',
        'doc',
        'prestation_types_id'
    ];

    public function prestationType():BelongsTo
    {
        return $this->belongsTo(PrestationType::class, 'prestation_types_id');
    }
}
