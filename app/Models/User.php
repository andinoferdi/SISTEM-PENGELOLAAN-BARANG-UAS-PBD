<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'user';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'username', 'password', 'role_id'
    ];

    public $timestamps = false;

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }
}
