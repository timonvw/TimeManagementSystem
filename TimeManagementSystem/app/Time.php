<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
