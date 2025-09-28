<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Investment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'package_id',
        'initial_deposit',
        'status',
        'start_date',
        'last_payout_date',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    protected $casts = [
        'initial_deposit' => 'decimal:2',
        'start_date' => 'datetime',
        'last_payout_date' => 'datetime',
    ];

    public function dailyInterestPayouts()
    {
        return $this->hasMany(DailyInterestPayout::class);
    }

}
