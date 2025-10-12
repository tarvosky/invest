<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = ['txid','invoice_id','user_id','value','status','payload'];
    protected $casts = [
        'payload' => 'array',
    ];

    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
