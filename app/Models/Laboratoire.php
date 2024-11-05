<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laboratoire extends Model
{
    use HasFactory;

    protected $table = 'laboratoires';

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'doc',
        'laboratoire_types_id'
    ];

    public function getDoc()
    {
        if ($this->doc && file_exists(public_path('storage/'.config('global.file_laboratoire').'/'.$this->doc))) {
            $doc = asset('storage/'.config('global.file_laboratoire').'/'.$this->doc);
        } else {
            return 'Document not found';
        }

        return $doc;
    }

    public function laboratoireType(): BelongsTo
    {
        return $this->BelongsTo(LaboratoireType::class, 'laboratoire_types_id');
    }
}
