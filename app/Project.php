<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'thumbnail', 'created_at','updated_at','user_id'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
  ];
    public function user()
    {
      //$project->user();
      return $this->belongsTo('App\User');
    }

    public function tasks()
    {
      return $this->hasMany('App\Task');
    }
}
