<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'designation',
        'address',
        'locality_id',
        'website',
        'phone',
    ];

   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'locations';

   /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the locality of the location
     */
    public function locality()
    {
        return $this->belongsTo(Locality::class);
    }

    /**
     * Get the shows in this location.
     */
    public function shows()
    {
        return $this->hasMany(Show::class);
    }

    /**
     * Get the representations in this location.
     */
    public function representations()
    {
        return $this->hasMany(Representation::class);
    }

}
