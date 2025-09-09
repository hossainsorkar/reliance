<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

    protected $fillable = [
        'party_name',
        'party_type',
        'contact_info',
        'address',
        'status',
    ];

        public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function jobs()
{
    return $this->hasMany(\App\Models\Job::class, 'party_id');
}

}
