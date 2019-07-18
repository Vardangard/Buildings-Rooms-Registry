<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pastatas extends Model
{
    protected $connection = 'tvarkis';
    
    protected $table = 'pastatas';

    protected $primaryKey = 'id';

    public function patalpa()
    {
        return $this->hasMany('App\Patalpa');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'tvarkis.assigns');
    }

}
