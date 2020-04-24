<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable = ['name'];

    // defining an accessor
    public function getNameAttribute($name){

        return ucfirst($name);

    }

}
