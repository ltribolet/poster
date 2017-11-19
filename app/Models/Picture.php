<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = [
        'title',
        'description',
        'iso',
        'shutter',
        'aperture',
        'focal',
        'make',
        'model',
        'shoot_at',
        'width',
        'height',
        'type',
        'size',
        'url',
        'thumbUrl',
        'checksum',
        'note',
        'fav',
        'exif',
    ];

    /**
     * Get the album of the picture.
     */
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
