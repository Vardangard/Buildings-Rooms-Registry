<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pertvara extends Model
{
    protected $connection = 'luadm';
    
    protected $table = 'pp_pertvaros'; //protected $table = 'pertvaros'; !INCASE OF ABORT!\\

    protected $primaryKey = 'id';

    public function patalpa() 
    {
        return $this->belongsTo('App\Patalpa', 'patalpos_id');
    }
}
