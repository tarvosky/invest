<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacate extends Model
{
    use HasFactory;
        protected  $fillable = ['first_name','last_name','landlord_first_name','landlord_last_name','form_date','vacating_date','street','city','zip','state','tenant_signature','landlord_signature'];
        protected  $table = 'vacates';
}
