<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'name',
        'description',
        'isDownload',
        'visibility',
        'sort'
    ];

    /**
     * Get the pictures for the album.
     */
    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }

    /**
     * Get the owner of the album.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
