@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $article->title }}</h1>
    @if ($article->image)
        <img src="{{ asset('images/' . $article->image) }}" width="400" />
    @endif
    <p>{{ $article->content }}</p>
    <a href="{{ route('beranda') }}">← Kembali</a>
</div>
@endsection
