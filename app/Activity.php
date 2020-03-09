<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'text',
        'board_id'
    ];

    public function board()
    {
        return $this->belongsTo('App\Board');
    }
}
