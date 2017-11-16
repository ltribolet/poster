<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    /**
     * Get the album of the picture.
     */
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
