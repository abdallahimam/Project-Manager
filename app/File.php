<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class File extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'realname', 'path', 'size', 'mime', 'user_id', 'project_id', 'extension', 
    ];

    protected $date = ['deleted_at'];

    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    
    public function project() {
        return $this->belongsTo('App\Project', 'project_id', 'id');
    }
}
