<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Company extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'description', 'user_id'
    ];

    protected $date = ['deleted_at'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function employers() {
        return $this->hasMany('App\User', 'work_at');
    }

    public function projects() {
        return $this->hasMany('App\Project');
    }

    public function comments() {
        return $this->morphMany('App\Comment', 'commentable');
    }

}
