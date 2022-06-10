<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'show_id',
        'when',
        'location_id',
    ];

   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'representations';

   /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    /**
     * Get the actual room of the representation
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    
    /**
     * Get the show of the representation
     */
    public function show()
    {
        return $this->belongsTo(Show::class);
    }

}
