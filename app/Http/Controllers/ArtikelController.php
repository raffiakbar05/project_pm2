<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get();
        return view('beranda', compact('articles'));

    }

    public function create()
    {
        return view('article.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = null;

        // Handle upload gambar
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        // Simpan ke database
        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath
        ]);

        return redirect()->route('beranda')->with('success', 'Artikel berhasil dibuat!');
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }
}