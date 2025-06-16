@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Artikel</h2>
    <form action="{{ route('article.update', $article) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label>Judul</label>
        <input type="text" name="title" value="{{ $article->title }}" required>
        <label>Isi</label>
        <textarea name="content" rows="5" required>{{ $article->content }}</textarea>
        <label>Gambar (opsional)</label>
        <input type="file" name="image">
        @if ($article->image)
            <p>Gambar saat ini: <img src="{{ asset('images/' . $article->image) }}" width="100"></p>
        @endif
        <button type="submit">Simpan</button>
    </form>
</div>
@endsection
