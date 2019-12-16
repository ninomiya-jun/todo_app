<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['detail'];

    public function tags() {
        return $this -> belongsToMany('App/Tag');
    }
    public function comments() {
        return $this -> belongsTo('App/Comment');
    }
}
