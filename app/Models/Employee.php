<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected  $table = 'employees';



    public function users()
    {
        return $this->belongsTo(User::class);
    }
    
}
