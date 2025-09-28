<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redemption extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected  $table = 'redemptions';
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
