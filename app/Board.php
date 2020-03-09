<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $fillable = [
        'name',
        'user_id',
    ];

    //Relationships

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function boardMembers()
    {
        return $this->belongsToMany('App\User');
    }

    public function activities()
    {
        return $this->hasMany('App\Activity');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
