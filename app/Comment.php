<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url', 'body', 'commentable_id', 'commentable_type', 'user_id'
    ];

    protected $date = ['deleted_at'];

    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function commentable() {
        return $this->morphTo();
    }
}
