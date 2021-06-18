<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tag'];

   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tags';

   /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the shows marked by the tag
     */
    public function shows()
    {
        return $this->belongsToMany(Show::class);
    }
}
