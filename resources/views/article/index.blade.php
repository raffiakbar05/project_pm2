@extends('layouts.app')

@section('content')
<div class="container text-dark">
    <h1 class="text-dark">Daftar Artikel</h1>
    <a href="{{ route('article.create') }}" class="btn btn-primary mb-3 text-white">Tambah Artikel</a>
    @foreach ($articles as $article)
        <div class="mb-4">
            <h3 class="text-dark">{{ $article->title }}</h3>
            @if ($article->image)
                <img src="{{ asset('images/' . $article->image) }}" width="300" />
            @endif
            <p class="text-dark">{{ Str::limit($article->content, 150) }}</p>
            <a href="{{ route('article.show', $article) }}" class="text-dark">Lihat</a> |
            <a href="{{ route('article.edit', $article) }}" class="text-dark">Edit</a> |
            <form action="{{ route('article.destroy', $article) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-dark" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
            </form>
        </div>
    @endforeach
</div>
@endsection
