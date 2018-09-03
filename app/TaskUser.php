<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'task_user';

    protected $fillable = [
        'user_id', 'task_id'
    ];

    /**
     *    public function user() {
     *        return $this->belongsTo('App\User');
     *    }
     *
     *    public function task() {
     *        return $this->belongsTo('App\Task');
     *    }
     */

    

}
