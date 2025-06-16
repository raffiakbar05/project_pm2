<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Manajemen Artikel') | {{ config('app.name', 'ArtikelKu') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet" />
    
    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        /* Custom animations */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .slide-down {
            animation: slideDown 0.2s ease-out;
        }
        
        /* Smooth transitions */
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #3B82F6, #1D4ED8);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        /* Button hover effects */
        .btn-primary {
            background: linear-gradient(135deg, #3B82F6, #1D4ED8);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #1D4ED8, #1E40AF);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }
        
        /* Mobile menu animation */
        .mobile-menu-enter {
            opacity: 0;
            transform: translateY(-10px);
        }
        
        .mobile-menu-enter-active {
            opacity: 1;
            transform: translateY(0);
            transition: all 0.3s ease;
        }
        
        /* Backdrop blur effect */
        .navbar-blur {
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gradient-to-br from-gray-50 to-blue-50 text-gray-800 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="navbar-blur bg-white/80 shadow-lg border-b border-white/20 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-14 sm:h-16">
                <!-- Logo / Judul Aplikasi -->
                <div class="flex-shrink-0">
                    <a href="{{ route('beranda') }}" class="flex items-center space-x-2 group">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-105">
                            <i class="fas fa-newspaper text-white text-sm sm:text-base"></i>
                        </div>
                        <span class="text-lg sm:text-xl lg:text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                            {{ config('app.name', 'ArtikelKu') }}
                        </span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-1 lg:space-x-2">
                    <a href="{{ route('beranda') }}" class="nav-link text-gray-600 hover:text-blue-600 font-medium px-3 lg:px-4 py-2 rounded-lg hover:bg-blue-50 transition-all duration-300 {{ request()->routeIs('beranda') ? 'text-blue-600 bg-blue-50' : '' }}">
                        <i class="fas fa-home mr-2 text-sm"></i>
                        Beranda
                    </a>
                    @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="{{ route('admin.index') }}" class="nav-link text-gray-600 hover:text-blue-600 font-medium px-3 lg:px-4 py-2 rounded-lg hover:bg-blue-50 transition-all duration-300 {{ request()->routeIs('admin.index') ? 'text-blue-600 bg-blue-50' : '' }}">
                        <i class="fas fa-home mr-2 text-sm"></i>
                        Admin Panel
                    </a>
                    @endif

                    @auth
                        <a href="{{ route('articles.index') }}" class="nav-link text-gray-600 hover:text-blue-600 font-medium px-3 lg:px-4 py-2 rounded-lg hover:bg-blue-50 transition-all duration-300 {{ request()->routeIs('articles.*') ? 'text-blue-600 bg-blue-50' : '' }}">
                            <i class="fas fa-list mr-2 text-sm"></i>
                            Artikel Saya
                        </a>
                    @endauth

                    <!-- Guest Navigation -->
                    @guest
                    <div class="flex items-center space-x-2 ml-4">
                        <a href="{{ route('login') }}" class="nav-link text-gray-600 hover:text-blue-600 font-medium px-3 lg:px-4 py-2 rounded-lg hover:bg-blue-50 transition-all duration-300">
                            <i class="fas fa-sign-in-alt mr-2 text-sm"></i>
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 lg:px-6 py-2 rounded-lg font-semibold hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg hover:shadow-xl">
                            <i class="fas fa-user-plus mr-2 text-sm"></i>
                            Register
                        </a>
                    </div>
                    @endguest

                    <!-- Auth Navigation -->
                    @auth
                    <div class="flex items-center space-x-2 ml-4">
                        <a href="{{ route('articles.create') }}" class="btn-primary text-white px-3 lg:px-4 py-2 rounded-lg shadow-lg font-medium flex items-center space-x-2">
                            <i class="fas fa-plus text-sm"></i>
                            <span class="hidden lg:inline">Tambah Artikel</span>
                            <span class="lg:hidden">Tambah</span>
                        </a>

                        <div class="flex items-center space-x-3 ml-4 pl-4 border-l border-gray-200">
                            <div class="hidden lg:flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white text-xs"></i>
                                </div>
                                <span class="text-sm text-gray-600">
                                    Halo, <span class="font-semibold text-gray-800">{{ Auth::user()->name }}</span>
                                </span>
                            </div>
                            
                            <!-- Dropdown Profile -->
                            <div class="relative group">
                                <button class="flex items-center space-x-2 text-gray-600 hover:text-blue-600 font-medium transition-colors duration-300 hover:bg-blue-50 px-3 py-2 rounded-lg">
                                    <i class="fas fa-user-circle text-lg"></i>
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </button>
                                
                                <!-- Dropdown Menu -->
                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                                    <div class="py-2">
                                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center space-x-2">
                                            <i class="fas fa-user-edit w-4"></i>
                                            <span>Edit Profile</span>
                                        </a>
                                        <hr class="my-2">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center space-x-2">
                                                <i class="fas fa-sign-out-alt w-4"></i>
                                                <span>Logout</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" id="mobile-menu-button" class="text-gray-600 hover:text-blue-600 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 p-2 rounded-lg transition-all duration-300">
                        <span class="sr-only">Open main menu</span>
                        <i id="menu-icon" class="fas fa-bars text-lg"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div id="mobile-menu" class="md:hidden hidden slide-down">
                <div class="px-2 pt-2 pb-3 space-y-1 bg-white/90 backdrop-blur-lg rounded-lg mt-2 shadow-xl border border-white/20">
                    <a href="{{ route('beranda') }}" class="block px-4 py-3 text-base font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300 flex items-center space-x-3 {{ request()->routeIs('beranda') ? 'text-blue-600 bg-blue-50' : '' }}">
                        <i class="fas fa-home text-blue-500 w-5"></i>
                        <span>Beranda</span>
                    </a>

                    @auth
                    <a href="{{ route('articles.index') }}" class="block px-4 py-3 text-base font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300 flex items-center space-x-3 {{ request()->routeIs('articles.*') ? 'text-blue-600 bg-blue-50' : '' }}">
                        <i class="fas fa-list text-blue-500 w-5"></i>
                        <span>Artikel Saya</span>
                    </a>
                    @endauth

                    <!-- Guest Mobile Menu -->
                    @guest
                    <div class="space-y-1 pt-2 border-t border-gray-100">
                        <a href="{{ route('login') }}" class="block px-4 py-3 text-base font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300 flex items-center space-x-3">
                            <i class="fas fa-sign-in-alt text-blue-500 w-5"></i>
                            <span>Login</span>
                        </a>
                        <a href="{{ route('register') }}" class="block mx-4 mb-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-3 rounded-lg shadow-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 flex items-center space-x-3 font-semibold">
                            <i class="fas fa-user-plus w-5"></i>
                            <span>Register</span>
                        </a>
                    </div>
                    @endguest

                    <!-- Auth Mobile Menu -->
                    @auth
                    <div class="space-y-1 pt-2 border-t border-gray-100">
                        <div class="px-4 py-3 text-sm bg-blue-50 rounded-lg mx-2 mb-3 flex items-center space-x-3">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-xs"></i>
                            </div>
                            <div>
                                <span class="text-gray-500">Halo,</span>
                                <span class="font-semibold text-gray-800 block">{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                        
                        <a href="{{ route('articles.create') }}" class="block mx-4 mb-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-3 rounded-lg shadow-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 flex items-center space-x-3 font-semibold">
                            <i class="fas fa-plus w-5"></i>
                            <span>Tambah Artikel</span>
                        </a>

                        <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-base font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300 flex items-center space-x-3">
                            <i class="fas fa-user-edit text-blue-500 w-5"></i>
                            <span>Edit Profile</span>
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-3 text-base font-medium text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-all duration-300 flex items-center space-x-3">
                                <i class="fas fa-sign-out-alt text-red-500 w-5"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg shadow-sm flex items-center">
                <i class="fas fa-check-circle mr-3 text-green-500"></i>
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="ml-auto text-green-500 hover:text-green-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg shadow-sm flex items-center">
                <i class="fas fa-exclamation-circle mr-3 text-red-500"></i>
                <span>{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="ml-auto text-red-500 hover:text-red-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg shadow-sm">
                <div class="flex items-center mb-2">
                    <i class="fas fa-exclamation-triangle mr-3 text-red-500"></i>
                    <span class="font-semibold">Terjadi kesalahan:</span>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-auto text-red-500 hover:text-red-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <ul class="list-disc list-inside ml-6 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white/70 backdrop-blur-lg border-t border-white/20 py-6 mt-auto">
        <div class="max-w-7xl mx-auto text-center px-4">
            <p class="text-sm text-gray-600">
                © {{ date('Y') }} {{ config('app.name', 'ArtikelKu') }}. Dibuat dengan 
                <i class="fas fa-heart text-red-500 mx-1"></i>
                oleh Developer Indonesia.
            </p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');

            // Mobile menu toggle
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isHidden = mobileMenu.classList.contains('hidden');
                    
                    if (isHidden) {
                        mobileMenu.classList.remove('hidden');
                        menuIcon.className = 'fas fa-times text-lg';
                        setTimeout(() => mobileMenu.classList.add('slide-down'), 10);
                    } else {
                        mobileMenu.classList.add('hidden');
                        menuIcon.className = 'fas fa-bars text-lg';
                        mobileMenu.classList.remove('slide-down');
                    }
                });

                // Close mobile menu when clicking outside
                document.addEventListener('click', function(event) {
                    if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                        mobileMenu.classList.add('hidden');
                        menuIcon.className = 'fas fa-bars text-lg';
                        mobileMenu.classList.remove('slide-down');
                    }
                });

                // Close mobile menu when window is resized to desktop
                window.addEventListener('resize', function() {
                    if (window.innerWidth >= 768) {
                        mobileMenu.classList.add('hidden');
                        menuIcon.className = 'fas fa-bars text-lg';
                        mobileMenu.classList.remove('slide-down');
                    }
                });
            }

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Auto-hide flash messages after 5 seconds
            setTimeout(function() {
                const flashMessages = document.querySelectorAll('[class*="bg-green-50"], [class*="bg-red-50"]');
                flashMessages.forEach(function(message) {
                    if (message.closest('.max-w-7xl')) {
                        message.style.transition = 'opacity 0.5s ease-out';
                        message.style.opacity = '0';
                        setTimeout(() => message.remove(), 500);
                    }
                });
            }, 5000);
        });
    </script>

    @stack('scripts')
</body>
</html>