<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    /**
     * Get the subscriber that owns the field.
     */
    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }
}
