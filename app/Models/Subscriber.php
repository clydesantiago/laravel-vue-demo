<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email_address', 'state'];

    /**
     * Get the fields for the subscriber.
     */
    public function fields()
    {
        return $this->hasMany(Field::class);
    }
}
