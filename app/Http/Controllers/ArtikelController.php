<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ArtikelController extends Controller
{
    public function index()
    {
        $articles = Article::where('status', 'published')
                          ->latest('published_at')
                          ->get();
        return view('beranda', compact('articles'));
    }

    public function create()
    {
        return view('article.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'status' => $request->status,
            'user_id' => Auth::id(), // Assuming user authentication
        ];

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $thumbnailName = time().'.'.$request->thumbnail->extension();
            $request->thumbnail->move(public_path('images'), $thumbnailName);
            $data['thumbnail'] = $thumbnailName;
        }

        // Set published_at if status is published
        if ($request->status === 'published') {
            $data['published_at'] = now();
        }

        Article::create($data);

        return redirect()->route('beranda')->with('success', 'Artikel berhasil disimpan!');
    }

    public function show(Article $article)
    {
        // Only show published articles or allow author to see their own drafts
        if ($article->status !== 'published' && $article->user_id !== Auth::id()) {
            abort(404);
        }

        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        // Only allow author to edit their own articles
        if ($article->user_id !== Auth::id()) {
            abort(403);
        }

        return view('article.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        // Only allow author to update their own articles
        if ($article->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'status' => $request->status,
        ];

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($article->thumbnail && file_exists(public_path('images/' . $article->thumbnail))) {
                unlink(public_path('images/' . $article->thumbnail));
            }

            $thumbnailName = time().'.'.$request->thumbnail->extension();
            $request->thumbnail->move(public_path('images'), $thumbnailName);
            $data['thumbnail'] = $thumbnailName;
        }

        // Set published_at if status changed to published and wasn't published before
        if ($request->status === 'published' && $article->status !== 'published') {
            $data['published_at'] = now();
        }

        $article->update($data);

        return redirect()->route('beranda')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Article $article)
    {
        // Only allow author to delete their own articles
        if ($article->user_id !== Auth::id()) {
            abort(403);
        }

        // Delete thumbnail if exists
        if ($article->thumbnail && file_exists(public_path('images/' . $article->thumbnail))) {
            unlink(public_path('images/' . $article->thumbnail));
        }

        $article->delete();

        return redirect()->route('beranda')->with('success', 'Artikel berhasil dihapus!');
    }

    public function m()
    {
        // Show all articles for management (assuming admin view)
        $articles = Article::with('user')->latest()->get();
        return view('article.index', compact('articles'));
    }

    // Additional method to show drafts for authenticated user
    public function drafts()
    {
        $articles = Article::where('user_id', Auth::id())
                          ->where('status', 'draft')
                          ->latest()
                          ->get();
        return view('article.drafts', compact('articles'));
    }
}