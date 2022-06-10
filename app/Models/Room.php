<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['name','seats'];

    protected $table = 'rooms';

    public $timestamps = false;

    /**
     * Get the actual location of the room
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the representations in this room.
     */
    public function representations()
    {
        return $this->hasMany(Representation::class);
    }
}
