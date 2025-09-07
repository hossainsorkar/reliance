<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseField extends Model
{
    use HasFactory;

    protected $fillable = [
        'terminal_id',
        'expense_type',
        'commission_rate',
        'min_commission',
        'max_commission',
        'created_by',
        'status',
    ];

    // Relationship with Terminal
    public function terminal()
    {
        return $this->belongsTo(Terminal::class);
    }
}
