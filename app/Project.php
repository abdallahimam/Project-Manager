<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'days', 'user_id', 'company_id'
    ];

    protected $date = ['deleted_at'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function employers() {
        return $this->belongsToMany('App\User');
    }

    public function company() {
        return $this->belongsTo('App\Company');
    }

    public function tasks() {
        return $this->hasMany('App\Task');
    }

    public function comments() {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function files() {
        return $this->hasMany('App\File');
    }

}
