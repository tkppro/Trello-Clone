<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'title',
        'description',
        'order',
        'task_id',
    ];

    //Relationships

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function list()
    {
        return $this->belongsTo('App\List');
    }
}
