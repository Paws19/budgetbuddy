<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    protected $table = 'account';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'verification_code',
        'is_verified',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'verification_code',
        'remember_token',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_active'   => 'boolean',
        'first_name' => 'encrypted',
        'last_name' => 'encrypted',
    ];

    

    
}
