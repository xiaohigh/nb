<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    public function articles()
    {
        return $this->belongsToMany('App\Models\Article');
    }

    public static function getTags()
    {
        return self::all();
    }
}
