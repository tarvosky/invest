<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected  $table = 'statements';



    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }



    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

}
