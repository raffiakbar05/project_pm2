@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Article Details</h1>
            <div class="flex space-x-2">
                <a href="{{ route('admin.edit', $article) }}" 
                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-300">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <a href="{{ route('admin.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>Back
                </a>
            </div>
        </div>

        <!-- Article Card -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Thumbnail -->
            @if($article->thumbnail)
            <div class="w-full h-64 bg-gray-200">
                <img src="{{ asset('storage/' . $article->thumbnail) }}" 
                     alt="{{ $article->title }}" 
                     class="w-full h-full object-cover">
            </div>
            @endif

            <!-- Content -->
            <div class="p-6">
                <!-- Status Badge -->
                <div class="mb-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        {{ $article->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        <i class="fas fa-circle mr-2 text-xs"></i>
                        {{ ucfirst($article->status) }}
                    </span>
                </div>

                <!-- Title -->
                <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $article->title }}</h2>

                <!-- Meta Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 p-4 bg-gray-50 rounded-lg">
                    <div>
                        <label class="text-sm font-medium text-gray-600">Slug:</label>
                        <p class="text-gray-800">{{ $article->slug }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-600">Status:</label>
                        <p class="text-gray-800">{{ ucfirst($article->status) }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-600">Created At:</label>
                        <p class="text-gray-800">{{ $article->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-600">Published At:</label>
                        <p class="text-gray-800">
                            {{ $article->published_at ? $article->published_at->format('d M Y, H:i') : 'Not published' }}
                        </p>
                    </div>
                </div>

                <!-- Content -->
                <div class="prose max-w-none">
                    <label class="text-sm font-medium text-gray-600 block mb-2">Content:</label>
                    <div class="bg-gray-50 p-4 rounded-lg border">
                        {!! nl2br(e($article->content)) !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-6 flex justify-end space-x-2">
            <form action="{{ route('admin.destroy', $article) }}" method="POST" 
                  onsubmit="return confirm('Are you sure you want to delete this article?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-300">
                    <i class="fas fa-trash mr-2"></i>Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection