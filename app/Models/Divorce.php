<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divorce extends Model
{
    use HasFactory;
    protected  $table = 'divorces';
    protected $guarded = ['id'];


    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
