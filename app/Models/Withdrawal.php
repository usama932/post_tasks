<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'amount',
        'payment_method',
        'status',
        'account_number',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

