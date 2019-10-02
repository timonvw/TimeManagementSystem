<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //moet weg na tutorial
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function times()
    {
        return $this->hasMany(Time::class);
    }
}
