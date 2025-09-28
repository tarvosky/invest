<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Xfinity extends Model
{
    use HasFactory;
    protected  $table = 'xfinities';
    protected $guarded = ['id'];


    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
