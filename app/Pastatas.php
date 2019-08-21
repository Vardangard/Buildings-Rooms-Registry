<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pastatas extends Model
{
    protected $connection = 'luadm';
    
    protected $table = 'pp_pastatai'; //protected $table = 'pastatas'; !INCASE OF ABORT! \\

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['updated_at', 'created_at']; 

    public function patalpa()
    {
        return $this->hasMany('App\Patalpa');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'assigns'); // luadm.assigns
    }

    //ALTERNATIVE TIME TABLE
    //public function laikas()
    //{
    //    return $this->hasOne('App\Laikas');
    //}

}
