<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terminal extends Model
{
    use HasFactory;

    protected $fillable = [
        'terminal_name',
        'terminal_short_name',
        'terminal_type',
        'address',
        'about',
        'status',
    ];
}
