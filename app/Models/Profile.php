<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'dob', 'address', 'phone', 'id_type', 'id_front_path', 'id_back_path'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
