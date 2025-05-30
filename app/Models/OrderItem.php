<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // Agar mass assignment bisa dilakukan pada kolom berikut:
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    // Relasi ke Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi ke Product (jika ingin)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}