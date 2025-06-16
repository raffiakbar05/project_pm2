@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-blue-100 text-gray-800">
  <!-- Header -->
  <header class="bg-blue-200 text-center py-8">
    <h1 class="text-4xl font-bold text-blue-700 m-0">Website Artikel</h1>
  </header>

  <!-- Container -->
  <div class="w-11/12 max-w-4xl mx-auto py-8">
    <!-- Article 1 -->
    <div class="bg-white mb-6 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
      <h2 class="text-2xl font-bold text-blue-600 mb-3">Judul Artikel</h2>
      <p class="text-gray-600 mb-4 leading-relaxed">Isi artikel singkat...</p>
      <a href="#" class="inline-block px-5 py-2.5 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600 transition-colors duration-300 no-underline">
        Baca Selengkapnya
      </a>
    </div>

    <!-- Article 2 -->
    <div class="bg-white mb-6 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
      <h2 class="text-2xl font-bold text-blue-600 mb-3">Judul Artikel Lain</h2>
      <p class="text-gray-600 mb-4 leading-relaxed">Isi artikel singkat...</p>
      <a href="#" class="inline-block px-5 py-2.5 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600 transition-colors duration-300 no-underline">
        Baca Selengkapnya
      </a>
    </div>

    <!-- Additional Article Examples -->
    <div class="bg-white mb-6 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
      <h2 class="text-2xl font-bold text-blue-600 mb-3">Teknologi Terbaru 2025</h2>
      <p class="text-gray-600 mb-4 leading-relaxed">Perkembangan teknologi AI dan machine learning yang mengubah cara kita bekerja dan berinteraksi...</p>
      <a href="#" class="inline-block px-5 py-2.5 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600 transition-colors duration-300 no-underline">
        Baca Selengkapnya
      </a>
    </div>

    <div class="bg-white mb-6 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
      <h2 class="text-2xl font-bold text-blue-600 mb-3">Tips Produktivitas</h2>
      <p class="text-gray-600 mb-4 leading-relaxed">Strategi efektif untuk meningkatkan produktivitas dalam kehidupan sehari-hari dan pekerjaan...</p>
      <a href="#" class="inline-block px-5 py-2.5 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600 transition-colors duration-300 no-underline">
        Baca Selengkapnya
      </a>
    </div>
  </div>
</div>
@endsection