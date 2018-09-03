<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'first_name', 'middle_name', 'last_name', 'city', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $date = ['deleted_at'];


    public function comments() {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function company() {
        return $this->belongsTo('App\Company', 'work_at');
    }

    public function companies() {
        return $this->hasMany('App\Company', 'user_id');
    }

    public function projects() {
        return $this->belongsToMany('App\Project');
    }

    public function tasks() {
        return $this->belongsToMany('App\Task');
    }

    public function role() {
        return $this->belongsTo('App\Role');
    }

}
