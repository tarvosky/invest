<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMS extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected  $table = 's_m_s';
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }









}
