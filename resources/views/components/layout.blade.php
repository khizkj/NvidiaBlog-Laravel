<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Nvidia Blog')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --nvidia-green: #76B900;
            --nvidia-dark: #0D1117;
            --nvidia-gray: #1C1C1C;
        }

        .nvidia-gradient {
            background: linear-gradient(135deg, var(--nvidia-dark) 0%, var(--nvidia-gray) 100%);
        }

        .nvidia-green {
            color: var(--nvidia-green);
        }

        .nvidia-green-bg {
            background-color: var(--nvidia-green);
        }

        .page-transition {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s ease-out forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hover-scale {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        .glow-effect {
            box-shadow: 0 0 20px rgba(118, 185, 0, .3);
            transition: box-shadow 0.3s ease;
        }

        .glow-effect:hover {
            box-shadow: 0 0 30px rgba(118, 185, 0, .5);
        }

        .navbar-blur {
            backdrop-filter: blur(10px);
            background: rgba(13, 17, 23, .9);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(118, 185, 0, .2);
        }

        .pagination .page-link {
            background-color: #1C1C1C;
            /* Nvidia gray */
            color: #76B900;
            /* Nvidia green */
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
        }

        .pagination .page-link:hover {
            background-color: #2C2C2C;
        }

        .pagination .active .page-link {
            background-color: #76B900;
            color: black;
        }
    </style>
</head>


<body class="bg-gray-900 text-white min-h-screen nvidia-gradient">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 navbar-blur border-b border-gray-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('blogs.home') }}" class="flex items-center space-x-3">
                        <div class="w-8 h-8 nvidia-green-bg rounded-lg flex items-center justify-center">
                            <i class="fas fa-bolt text-black font-bold"></i>
                        </div>
                        <span class="text-xl font-bold nvidia-green">NVIDIA</span>
                        <span class="text-sm text-gray-400">Blog</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('blogs.home') }}" @class([
                        'transition-colors',
                        'hover:text-white',
                        request()->routeIs('home') ? 'nvidia-green' : 'text-gray-300',
                    ])>
                        <i class="fas fa-home mr-2"></i>Home
                    </a>

                    <a href="{{ route('blogs.blog') }}" @class([
                        'transition-colors',
                        'hover:text-white',
                        request()->routeIs('blog', 'blog.*') ? 'nvidia-green' : 'text-gray-300',
                    ])>
                        <i class="fas fa-blog mr-2"></i>Blog
                    </a>

                    @guest
                        <a href="/login" class="block px-3 py-2 text-gray-300 hover:text-white transition-colors">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                    @endguest

                    @auth
                        @if (Auth::user()->is_admin)
                            <a href="/admin" class="block px-3 py-2 text-gray-300 hover:text-white transition-colors">
                                <i class="fa fa-users mr-2"></i>Admin Dashboard
                            </a>
                        @endif
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit"
                                class="block px-3 py-2 text-gray-300 hover:text-white transition-colors w-full text-left">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-300 hover:text-white focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="md:hidden hidden bg-gray-800 border-t border-gray-700">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('blogs.home') }}" @class([
                    'block px-3 py-2 transition-colors',
                    'hover:text-white',
                    request()->routeIs('home') ? 'nvidia-green' : 'text-gray-300',
                ])>
                    <i class="fas fa-home mr-2"></i>Home
                </a>

                <a href="{{ route('blogs.blog') }}" @class([
                    'block px-3 py-2 transition-colors',
                    'hover:text-white',
                    request()->routeIs('blog', 'blog.*') ? 'nvidia-green' : 'text-gray-300',
                ])>
                    <i class="fas fa-blog mr-2"></i>Blog
                </a>

                @guest
                    <a href="/login" class="block px-3 py-2 text-gray-300 hover:text-white transition-colors">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </a>
                @endguest

                @auth
                    @if (Auth::user()->is_admin)
                        <a href="/admin" class="block px-3 py-2 text-gray-300 hover:text-white transition-colors">
                            <i class="fa fa-users mr-2"></i>Admin Dashboard
                        </a>
                    @endif
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit"
                            class="block px-3 py-2 text-gray-300 hover:text-white transition-colors w-full text-left">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 border-t border-gray-700 mt-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-8 h-8 nvidia-green-bg rounded-lg flex items-center justify-center">
                            <i class="fas fa-bolt text-black font-bold"></i>
                        </div>
                        <span class="text-xl font-bold nvidia-green">NVIDIA</span>
                        <span class="text-sm text-gray-400">Blog</span>
                    </div>
                    <p class="text-gray-400 text-sm">
                        Discover the latest in AI, gaming, and graphics technology from NVIDIA.
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4 nvidia-green">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li>
                            <a href="{{ route('blogs.home') }}" @class([
                                'transition-colors hover:text-white',
                                request()->routeIs('home') ? 'nvidia-green' : 'text-gray-400',
                            ])>Home</a>
                        </li>
                        <li>
                            <a href="{{ route('blogs.blog') }}" @class([
                                'transition-colors hover:text-white',
                                request()->routeIs('blog', 'blog.*') ? 'nvidia-green' : 'text-gray-400',
                            ])>Blog</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4 nvidia-green">Follow Me</h4>
                    <div class="flex space-x-4">
                        <a href="https://github.com/khizkj" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/khizer-j-kj" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; 2025 NVIDIA Blog. Created By Khizer Jamil.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    if (mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.remove('hidden');
                    } else {
                        mobileMenu.classList.add('hidden');
                    }
                });
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href && href.startsWith('#')) {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });

        // Add page transition animation
        document.addEventListener('DOMContentLoaded', function() {
            document.body.classList.add('page-transition');
        });
    </script>
</body>

</html>
