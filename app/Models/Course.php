<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    public function lesson()
    {
        return $this->hasMany('App\Models\Lesson');
    }
}
