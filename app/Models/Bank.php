<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected  $table = 'banks';

    public function statements()
    {
        return $this->hasMany(Statement::class);
    }
}
