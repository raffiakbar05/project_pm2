<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Artikel | Aplikasi CRUD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Menggunakan font yang lebih modern */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<!-- [STRUKTUR] Menggunakan flex-col dan min-h-screen untuk sticky footer -->
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <!-- Navbar -->
    <!-- [UI/UX] Navbar dibuat sticky, dengan efek blur dan bayangan halus -->
    <nav class="bg-white/90 backdrop-blur-lg shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo / Judul Aplikasi -->
                <div class="flex-shrink-0">
                    <a href="{{ route('beranda') }}" class="text-2xl font-bold text-blue-600 hover:text-blue-700 transition-colors">
                        ArtikelKu
                    </a>
                </div>

                <!-- Navigasi & Tombol Aksi -->
                <div class="flex items-center space-x-6">
                    <a href="{{ route('beranda') }}" class="hidden md:block text-gray-600 hover:text-blue-600 font-medium transition-colors duration-300">Beranda</a>

                    {{-- Jika belum login --}}
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 font-medium transition-colors duration-300">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-100 text-blue-600 px-4 py-2 rounded-lg font-semibold hover:bg-blue-200 transition-all duration-300">Register</a>
                    @endguest

                    {{-- Jika sudah login --}}
                    @auth
                        <a href="{{ route('article.create') }}" class="flex items-center space-x-2 bg-blue-600 text-white px-4 py-2 rounded-lg shadow-sm hover:bg-blue-700 transition-all duration-300 transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            <!-- Ikon sederhana (SVG) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            <span>Tambah Artikel</span>
                        </a>

                        <div class="flex items-center space-x-4">
                            <span class="text-gray-600 hidden sm:block">Halo, <span class="font-semibold">{{ Auth::user()->name }}</span></span>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-700 font-medium transition-colors duration-300 hover:underline">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <!-- [STRUKTUR] flex-grow akan mendorong footer ke bawah -->
    <main class="flex-grow">
        <div class="container mx-auto mt-10 mb-12 px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <!-- [UI] Footer dengan background dan border atas untuk pemisah yang jelas -->
    <footer class="bg-white border-t border-gray-200 py-6">
        <div class="container mx-auto text-center">
            <p class="text-sm text-gray-500">
                © {{ date('Y') }} ArtikelKu. Dibuat dengan 💙 oleh Anda.
            </p>
        </div>
    </footer>

</body>
</html>