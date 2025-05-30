<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Jika ingin otomatis cast created_at dan updated_at ke Carbon:
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // Agar total_price bisa langsung diakses sebagai float:
    protected $casts = [
        'total_price' => 'float',
    ];

    // Tambahkan relasi ke OrderItem
public function items()
{
    return $this->hasMany(OrderItem::class);
}
public function user()
{
    return $this->belongsTo(User::class);
}
}