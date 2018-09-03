<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'days', 'hours', 'user_id', 'project_id', 'company_id'
    ];

    protected $date = ['deleted_at'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function project() {
        return $this->belongsTo('App\Project');
    }

    public function company() {
        return $this->belongsTo('App\Company');
    }

    public function employers() {
        return $this->belongsToMany('App\User');
    }

    public function comments() {
        return $this->morphMany('App\Comment', 'commentable');
    }

}
