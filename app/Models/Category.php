<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'type']; // ✅ Gunakan field yang sesuai dengan database

    // Relasi: satu kategori punya banyak produk
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
