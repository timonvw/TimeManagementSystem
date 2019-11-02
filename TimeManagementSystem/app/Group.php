<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Group
 *
 * @property int $id
 * @property int $admin_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Time[] $times
 * @property-read int|null $times_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Group whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Group extends Model
{
    protected $fillable = [
        'name',
        'admin_id'
        ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function times()
    {
        return $this->hasMany(Time::class);
    }
}
