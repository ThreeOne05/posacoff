<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
Schema::create('order_items', function (Blueprint $table) {
    $table->id(); // Primary key auto increment

    $table->foreignId('order_id')->constrained()->onDelete('cascade'); 
    // Foreign key ke tabel orders, jika order dihapus, item terkait ikut terhapus

    $table->foreignId('product_id')->constrained()->onDelete('cascade'); 
    // Foreign key ke tabel products, jika produk dihapus, item terkait ikut terhapus

    $table->integer('quantity'); 
    // Jumlah produk yang dipesan pada item ini

    $table->decimal('price', 10, 2); 
    // Harga satuan produk saat transaksi (bisa berbeda dengan harga produk sekarang)

    $table->timestamps(); // created_at dan updated_at
});
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
