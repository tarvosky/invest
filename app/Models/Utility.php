<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utility extends Model
{
    use HasFactory;
    protected  $table = 'utilities';
    protected $guarded = ['id'];


    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
