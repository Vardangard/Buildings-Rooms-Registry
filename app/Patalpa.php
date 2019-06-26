<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patalpa extends Model
{
    public $table = "patalpas";

    public function pastatas()
    {
        return $this->belongsTo('App\Pastatas', 'pastatai_id');
    }

    public function pertvara()
    {
        return $this->hasMany('App\Pertvara');
    }
}
