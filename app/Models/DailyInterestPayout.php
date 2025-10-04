<?php

namespace App\Models;

use database\Investment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyInterestPayout extends Model
{

    use HasFactory;

    protected $fillable = [
        'investment_id',
        'amount',
    ];

    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }
}
