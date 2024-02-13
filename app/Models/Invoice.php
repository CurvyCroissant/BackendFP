<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
    ];

    protected $casts = [
        'sender_address',
        'post_code',
        'subtotal',
        'total',
        'quantity',
    ];
    public function cart(){
        return $this->belongsTo(Cart::class);
    }

    protected $table = 'invoices';

}
