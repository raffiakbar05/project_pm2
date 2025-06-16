<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['user_id'] = Auth::id(); // Add the authenticated user's ID
        
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        if ($request->status === 'published') {
            $data['published_at'] = Carbon::now();
        }

        Article::create($data);

        return redirect()->route('admin.index')
            ->with('success', 'Article created successfully.');
    }

    public function show(Article $article)
    {
        return view('admin.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('admin.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($article->thumbnail && file_exists(storage_path('app/public/' . $article->thumbnail))) {
                unlink(storage_path('app/public/' . $article->thumbnail));
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        if ($request->status === 'published' && $article->status !== 'published') {
            $data['published_at'] = Carbon::now();
        } elseif ($request->status === 'draft') {
            $data['published_at'] = null;
        }

        $article->update($data);

        return redirect()->route('admin.index')
            ->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        // Delete thumbnail if exists
        if ($article->thumbnail && file_exists(storage_path('app/public/' . $article->thumbnail))) {
            unlink(storage_path('app/public/' . $article->thumbnail));
        }

        $article->delete();

        return redirect()->route('admin.index')
            ->with('success', 'Article deleted successfully.');
    }
}