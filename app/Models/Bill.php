<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_date',
        'bill_no',
        'type',
        'job_id',
        'party_id',
        'total_amount',
        'received_amount',
        'due_amount',
        'remarks',
    ];


    // Cast dates automatically to Carbon
    protected $casts = [
        'bill_date'  => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    // A bill belongs to a job
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    // A bill belongs to a party
    public function party()
    {
        return $this->belongsTo(Party::class);
    }
}
