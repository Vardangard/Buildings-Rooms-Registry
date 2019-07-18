<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{
    protected $connection = 'tvarkis';
    
    protected $table = 'assign';
}
