@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-blue-100 text-gray-800">
  <!-- Header -->
  <header class="bg-blue-200 text-center py-8">
    <h1 class="text-4xl font-bold text-blue-700 m-0">Website Artikel</h1>
  </header>

  <!-- Container -->
  <div class="w-11/12 max-w-4xl mx-auto py-8">
    @if($articles->count() > 0)
      @foreach($articles as $article)
        @if($article->status === 'published')
          <div class="bg-white mb-6 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <!-- Status Badge -->
            <div class="mb-3">
              <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                {{ ucfirst($article->status) }}
              </span>
              @if($article->published_at)
                <span class="text-gray-500 text-sm ml-2">
                  {{ $article->published_at->format('d M Y') }}
                </span>
              @endif
            </div>

            <!-- Article Thumbnail -->
            @if($article->thumbnail)
              <div class="mb-4">
                <img src="{{ asset('images/' . $article->thumbnail) }}" 
                     alt="{{ $article->title }}" 
                     class="w-full h-48 object-cover rounded-lg">
              </div>
            @endif

            <!-- Article Title -->
            <h2 class="text-2xl font-bold text-blue-600 mb-3">{{ $article->title }}</h2>
            
            <!-- Article Content Preview -->
            <p class="text-gray-600 mb-4 leading-relaxed">
              {{ Str::limit(strip_tags($article->content), 150) }}
            </p>
            
            <!-- Read More Button -->
            <a href="" 
               class="inline-block px-5 py-2.5 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600 transition-colors duration-300 no-underline">
              Baca Selengkapnya
            </a>
          </div>
        @endif
      @endforeach
    @else
      <!-- No Articles Message -->
      <div class="bg-white p-8 rounded-lg shadow-md text-center">
        <h3 class="text-xl font-semibold text-gray-600 mb-4">Belum ada artikel yang dipublikasikan</h3>
        <p class="text-gray-500">Silakan tambahkan artikel baru untuk ditampilkan di halaman ini.</p>
        <a href="{{ route('articles.create') }}" 
           class="inline-block mt-4 px-5 py-2.5 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600 transition-colors duration-300 no-underline">
          Tambah Artikel Baru
        </a>
      </div>
    @endif

    <!-- Pagination if needed -->
    @if(method_exists($articles, 'links'))
      <div class="mt-8">
        {{ $articles->links() }}
      </div>
    @endif
  </div>
</div>
@endsection