<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name',
        'order',
        'board_id',
        'archived',
    ];

    //Relationships

    public function board()
    {
        return $this->belongsTo('App\Board');
    }

    public function cards()
    {
        return $this->hasMany('App\Card');
    }
}
