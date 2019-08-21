<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patalpa extends Model
{
    protected $connection = 'luadm';
    
    protected $table = 'pp_patalpos'; //protected $table = 'patalpas'; !INCASE OF ABORT!\\

    protected $primaryKey = 'id';

    public function pastatas()
    {
        return $this->belongsTo('App\Pastatas', 'pastatai_id');
    }

    public function pertvara()
    {
        return $this->hasMany('App\Pertvara');
    }
}
