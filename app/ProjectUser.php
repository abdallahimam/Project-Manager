<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $table = 'project_user';

    protected $fillable = [
        'user_id', 'project_id'
    ];

    /**
     * 
     *  public function user() {
     *      return $this->belongsTo('App\User');
     *  }
     * 
     *  public function project() {
     *      return $this->belongsTo('App\Project');
     *  }
     * 
     */

}
