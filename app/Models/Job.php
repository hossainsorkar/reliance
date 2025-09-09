<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no',
        'buyer_name',
        'value_usd',
        'usd_rate_bdt',
        'voucher_amount',
        'party_id',
        'terminal_id',
        'employee_id',
        'items',
        'quantity',
        'weight',
        'ctns_pieces',
        'be_no',
        'lc_no',
        'sales_contact',
        'ud_no',
        'ud_amendment_no',
        'master_awb_bl_no',
        'house_awb_no',
        'job_no',
        'job_type',
        'job_status',
    ];

    public function party()
    {
        return $this->belongsTo(Party::class);
    }

    public function terminal()
    {
        return $this->belongsTo(Terminal::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function bills()
{
    return $this->hasMany(Bill::class);
}
}
