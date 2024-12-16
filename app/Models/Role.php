<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Role extends Authenticatable
{
    protected $table = 'role';

    protected $primaryKey = 'role_id';


    public $timestamps = false;

    
}
