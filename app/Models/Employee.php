<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

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

