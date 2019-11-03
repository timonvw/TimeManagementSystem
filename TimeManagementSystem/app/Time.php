<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * App\Time
 *
 * @property int $id
 * @property int $user_id
 * @property string $date
 * @property string $start_time
 * @property string $end_time
 * @property int $task_id
 * @property int $group_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $diffrence
 * @property-read \App\Group $group
 * @property-read \App\Task $task
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Time newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Time newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Time query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Time whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Time whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Time whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Time whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Time whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Time whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Time whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Time whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Time whereUserId($value)
 * @mixin \Eloquent
 */
class Time extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'start_time',
        'end_time',
        'task_id',
        'group_id'
        ];

    //maakt meteen carbon instatie van
    protected $dates = [
        'start_time',
        'end_time'
    ];

    public function getDiffrenceAttribute()
    {
        $diffrence = $this->start_time->diffInSeconds($this->end_time);

        return $this->start_time->diffInHours($this->end_time) . ':' . $this->start_time->diff($this->end_time)->format('%I');
    }

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
