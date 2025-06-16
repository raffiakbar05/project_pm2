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
    $request->validate([
        'title' => 'required',
        'content' => 'required',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only(['title', 'content']);

    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $data['image'] = $imageName;
    }

    Article::create($data);

    return redirect()->route('beranda')->with('success', 'Artikel berhasil disimpan!');
}

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }
}