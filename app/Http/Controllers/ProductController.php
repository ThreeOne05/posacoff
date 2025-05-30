<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Tampilkan daftar produk, semua atau paginasi
    public function index()
    {
        $products = Product::with('category')->paginate(12); // pake pagination
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    // Tampilkan produk berdasarkan kategori slug
    public function filterByCategory($type)
{
    $categories = Category::all();

    $category = Category::where('type', $type)->firstOrFail();

    $products = Product::with('category')
        ->where('category_id', $category->id)
        ->paginate(12);

    return view('products.index', compact('products', 'categories', 'category'));
}

    // Tampilkan form tambah produk
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // Simpan data produk baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'category_id', 'price', 'description']);

        // Upload gambar jika ada
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $path = $file->store('products', 'public'); // simpan di storage/app/public/products
            $data['image_path'] = 'storage/' . $path;   // prefix storage supaya bisa diakses public
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    // Tampilkan form edit produk
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    // Update data produk
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'category_id', 'price', 'description']);

        // Upload gambar baru jika ada, dan hapus file lama jika perlu (optional)
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $path = $file->store('products', 'public');

            // Hapus gambar lama jika ada
            if ($product->image_path) {
                $oldPath = str_replace('storage/', '', $product->image_path);
                Storage::disk('public')->delete($oldPath);
            }

            $data['image_path'] = 'storage/' . $path;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate');
    }

    // Hapus produk
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus gambar lama jika ada
        if ($product->image_path) {
            $oldPath = str_replace('storage/', '', $product->image_path);
            Storage::disk('public')->delete($oldPath);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus');
    }
}
