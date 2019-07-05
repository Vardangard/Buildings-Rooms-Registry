<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    protected $connection = 'luadm';
    
    protected $table = 'sso_users_permissions';


}
