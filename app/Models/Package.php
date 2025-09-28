<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'roi',
        'duration_days',
        'support_details',
        'commission',
    ];

    /**
     * Relationships
     */
    public function investments()
    {
        return $this->hasMany(Investment::class);
    }
}
