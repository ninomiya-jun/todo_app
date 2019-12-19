<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = ['detail','user_id','planned_at','finished_at'];

    protected $dates = [
        'planned_at', 'finished_at'
    ];

    public function tags() {
        return $this -> belongsToMany('App\Tag');
    }
    public function comments() {
        return $this -> hasMany('App\Comment');
    }
    public function user() {
        return $this -> belongsTo('App\User');
    }

}
