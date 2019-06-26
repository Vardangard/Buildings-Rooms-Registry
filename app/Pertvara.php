<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pertvara extends Model
{
    public function patalpa() 
    {
        return $this->belongsTo('App\Patalpa', 'patalpos_id');
    }
}
