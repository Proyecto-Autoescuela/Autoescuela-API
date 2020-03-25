<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //   hasmany contents
    public function contents(){
        return $this->hasMany('App\UnitContent');
    }

    public function questions(){
        return $this->hasMany('App\Question');
    }
}
