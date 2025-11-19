<?php
// File: app/Http/Controllers/Admin/ProductController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\ProdukGambar;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Menggantikan produk-admin.php (menampilkan list produk)
    public function index()
    {
        $products = Produk::with('gambar')->orderBy('terakhir_edit', 'desc')->get();
        return view('admin.products.index', compact('products'));
    }

    // Menampilkan form tambah produk
    public function create()
    {
        return view('admin.products.create');
    }

    // Menggantikan backend_admin/produk-insert.php
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:50',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'required|array', 
            'gambar.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 1. Buat ID Produk (menggantikan logika ID manual di PHP native)
        $latestProduct = Produk::orderBy('id_produk', 'desc')->first();
        $newId = 'P' . str_pad(((int)substr(optional($latestProduct)->id_produk, 1) + 1), 2, '0', STR_PAD_LEFT);

        // 2. Simpan data produk
        $product = Produk::create([
            'id_produk' => $newId,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'varian' => $request->varian,
            'stok' => $request->stok,
            'kategori' => $request->kategori,
            'is_bestseller' => $request->has('is_bestseller') ? 'Yes' : 'No',
        ]);

        // 3. Upload Gambar (menggantikan move_uploaded_file)
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/gambar_produk', $fileName); 
                
                ProdukGambar::create([
                    'id_produk' => $product->id_produk,
                    'nama_file' => $fileName,
                ]);
            }
        }
        
        // 4. Log Aktivitas (Sama seperti logika Audit Log PHP native)
        AuditLog::create([
            'id_admin' => Auth::guard('admin')->user()->id_admin,
            'nama_admin' => Auth::guard('admin')->user()->nama_admin,
            'aksi' => 'Menambah produk baru',
            'detail' => $product->nama . ' (ID: ' . $product->id_produk . ')',
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }
    
    // Menampilkan form edit produk
    public function edit(Produk $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // Menggantikan backend_admin/produk-update.php
    public function update(Request $request, Produk $product)
    {
        // 🚨 Logika Update data produk akan diletakkan di sini.
        $product->update($request->all());

        // 1. Log Aktivitas Update
        AuditLog::create([
            'id_admin' => Auth::guard('admin')->user()->id_admin,
            'nama_admin' => Auth::guard('admin')->user()->nama_admin,
            'aksi' => 'Mengubah produk',
            'detail' => $product->nama . ' (ID: ' . $product->id_produk . ')',
        ]);
        
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }
    
    // Menggantikan backend_admin/produk-delete.php
    public function destroy(Produk $product)
    {
        // Logika untuk menghapus gambar fisik dan entry database
        // (Perlu penanganan penghapusan gambar fisik di storage)
        
        // 1. Log Aktivitas Delete
        AuditLog::create([
            'id_admin' => Auth::guard('admin')->user()->id_admin,
            'nama_admin' => Auth::guard('admin')->user()->nama_admin,
            'aksi' => 'Menghapus produk',
            'detail' => $product->nama . ' (ID: ' . $product->id_produk . ')',
        ]);
        
        $product->delete(); // Menghapus record di database
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}