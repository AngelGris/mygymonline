<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'birthdate', 'height', 'weigth'
    ];

    /**
     * Fields to be trated as dates
     *
     * @var array
     */
    protected $dates = [
        'birthdate'
    ];

    /**
     * User's full name attribute
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Plans for the user
     */
    function plans()
    {
        return $this->belongsToMany(Plan::class);
    }
}
