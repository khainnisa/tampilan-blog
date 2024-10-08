<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    // tombol edit
    public function edit($id)
    {
        $categories = Category::findOrFail($id); // Cari data kategori berdasarkan ID
        return view('category.edit', compact('categories'));
    }

    // buat simpan perubaham
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);
    
        // Temukan kategori berdasarkan ID
        $category = Category::findOrFail($id);
        
        // Update data kategori
        $category->update($request->only(['name', 'description']));
    
        // Redirect ke halaman kategori dengan pesan sukses
        return redirect(to: '/category')->with('success', 'Category updated successfully!');
    }    
    
    // tombol hapus
    public function destroy($id)
    {
        $category = Category::findOrFail($id); // Mengambil model berdasarkan id
        $category->delete();
        return redirect('/category')->with('success', 'Category deleted successfully!');
    }

    // bingung di sini
    public function store(Request $request)
    {
        // Validasi input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        // Tambahkan slug ke dalam data
        $validatedData['slug'] = Str::slug($request->name);
    
        // Simpan data ke database
        Category::create($validatedData);
    
        // Redirect ke halaman index dengan pesan sukses
        return redirect(to: '/category')->with('success', 'Category created successfully!');
    }
    
}
