<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function forums()
    {
        return $this->belongsToMany('App\Forum');
    }
}
