<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pastatas extends Model
{
    protected $table = "pastatas";

    public function patalpa()
    {
        return $this->hasMany('App\Patalpa');
    }
}
