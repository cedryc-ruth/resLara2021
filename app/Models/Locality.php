<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{
    use HasFactory;

    protected $fillable = ['postalCode','locality'];

    protected $table = 'localities';

    public $timestamps = false;

    /**
     * Get the locations for the locality.
     */
    public function locations()
    {
        return $this->hasMany(Location::class);
    }

}
