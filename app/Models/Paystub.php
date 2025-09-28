<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paystub extends Model
{
    use HasFactory;
    protected  $table = 'paystubs';
    protected $guarded = ['id'];


    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
