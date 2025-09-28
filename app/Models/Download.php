<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected  $table = 'downloads';




    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
