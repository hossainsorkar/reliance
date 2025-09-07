<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins';

    protected $fillable = [
        'first_name',
        'last_name',
        'mobile',
        'email',
        'password',
        'department',
        'joining_date',
        'salary',
        'designation',
        'address',
        'gender',
        'dob',
        'role',
        'status',
        'can_login',
        'profile_picture',
    ];

    protected $hidden = ['password'];
}
