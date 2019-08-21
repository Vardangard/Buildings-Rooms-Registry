<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laikas extends Model
{
    protected $connection = 'luadm';
    
    protected $table = 'pp_pastatu_laikas'; //protected $table = 'patalpas'; !INCASE OF ABORT!\\

    protected $primaryKey = 'pastato_id';

    public $incrementing = false;

    public $timestamps = false;

    //protected $primaryKey = 'id';

    //public function pastatas()
    //{
    //    return $this->belongsTo('App\Pastatas');
    //}
}
