<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'plan_id'
    ];

    protected $with = [
        'exercises'
    ];

    /**
     * Exercises for the day
     */
    function exercises()
    {
        return $this->belongsToMany(Exercise::class);
    }
}
