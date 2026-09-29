<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Halaman Beranda
    public function home()
    {
        return view('home');
    }

    // Halaman Katalog (Publik + Pencarian)
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%");
        }

        $products = $query->latest()->get();
        return view('katalog', compact('products'));
    }

    // Halaman Detail Produk
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('detail', compact('product'));
    }

    // Halaman Admin (Daftar CRUD)
    public function admin(Request $request)
    {
        $query = Product::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%");
        }

        $products = $query->latest()->get();
        return view('admin.index', compact('products'));
    }

    // Form Tambah
    public function create()
    {
        return view('admin.create');
    }

    // Simpan Data Baru
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:products,kode',
            'nama' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|numeric|min:0',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'kode.required' => 'Kode produk wajib diisi.',
            'kode.unique' => 'Kode produk sudah ada.',
            'nama.required' => 'Nama produk wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'stok.numeric' => 'Stok harus berupa angka.'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('products', 'public');
        }

        Product::create($data);
        return redirect()->route('admin.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Form Edit
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit', compact('product'));
    }

    // Update Data
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'kode' => 'required|unique:products,kode,'.$product->id,
            'nama' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|numeric|min:0',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($product->gambar) {
                Storage::disk('public')->delete($product->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->route('admin.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // Hapus Data
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->gambar) {
            Storage::disk('public')->delete($product->gambar);
        }
        $product->delete();
        return redirect()->route('admin.index')->with('success', 'Produk berhasil dihapus!');
    }
}