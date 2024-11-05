<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';

    protected $fillable = [
        'title',
        'img',
        'img_alt',
        'doc',
        'doc_alt',
        'description',
        'document_types_id'
    ];

    public function getImg()
    {
        if ($this->img && file_exists(public_path('storage/'.config('global.image_document').'/'.$this->img))) {
            $img = asset('storage/'.config('global.image_document').'/'.$this->img);
        } else {
            $img = asset(config('global.default_image_logo'));
        }

        return $img;
    }

    public function getDoc()
    {
        if ($this->doc && file_exists(public_path('storage/'.config('global.file_document').'/'.$this->doc))) {
            $doc = asset('storage/'.config('global.file_document').'/'.$this->doc);
        } else {
            $doc = asset(config('global.default_image_logo2'));
        }

        return $doc;
    }

    public function str_limit(string $text, int $nombre)
    {
        return Str::words($text, $nombre ,' ...');
    }

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class, 'document_types_id');
    }
}
