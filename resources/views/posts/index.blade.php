@extends('components.layout')

@section('title', 'Home - Nvidia Blog')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-800 to-green-900 opacity-50"></div>
        <div class="relative z-10 text-center px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold mb-6 nvidia-green leading-tight">
                    Welcome to the Future
                </h1>
                <p class="text-xl sm:text-2xl text-gray-300 mb-8 leading-relaxed">
                    Discover cutting-edge AI, gaming, and graphics technology that's shaping tomorrow.
                    Dive into the world of innovation with NVIDIA's latest breakthroughs.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#explore"
                        class="inline-flex items-center px-8 py-4 nvidia-green-bg text-black font-semibold rounded-lg hover-scale glow-effect transition-all duration-300">
                        <i class="fas fa-rocket mr-2"></i>
                        Explore Blogs
                    </a>
                    <a href="#about"
                        class="inline-flex items-center px-8 py-4 border-2 border-green-500 text-green-500 font-semibold rounded-lg hover:bg-green-500 hover:text-black transition-all duration-300">
                        <i class="fas fa-info-circle mr-2"></i>
                        Learn More
                    </a>
                </div>
            </div>
        </div>

        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 left-10 w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            <div class="absolute top-40 right-20 w-1 h-1 bg-green-400 rounded-full animate-ping"></div>
            <div class="absolute bottom-20 left-1/4 w-3 h-3 bg-green-300 rounded-full animate-bounce"></div>
            <div class="absolute bottom-40 right-1/3 w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
        </div>
    </section>

    <!-- Explore Blogs Section -->
    <section id="explore" class="py-20 bg-gray-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl sm:text-5xl font-bold mb-6 nvidia-green">Explore Our Blogs</h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                    Stay updated with the latest innovations, tutorials, and insights from the world of AI and graphics
                    technology.
                </p>
            </div>

            <div class="text-center">
                <a href="{{ route('blogs.blog') }}"
                    class="inline-flex items-center px-10 py-5 nvidia-green-bg text-black font-bold text-lg rounded-lg hover-scale glow-effect transition-all duration-300">
                    <i class="fas fa-arrow-right mr-3"></i>
                    View All Blogs
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Blogs Section -->
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl sm:text-5xl font-bold mb-6 nvidia-green">Latest Blogs</h2>
                <p class="text-xl text-gray-300">Discover our latest articles</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Featured Blog 1 -->
                @foreach ($lastestblog as $blog)

                <div class="bg-gray-800 rounded-xl overflow-hidden card-hover">
                    <div
                            class="h-48 bg-gradient-to-br from-green-600 to-green-800 flex items-center justify-center relative overflow-hidden">
                            <img src="{{ asset('storage/' . $blog->image) }}"
                                class="object-cover w-full h-full transition-transform duration-300 hover:scale-105"
                                alt="{{ $blog->title }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        </div>
                    <div class="p-6">
                            <h3 class="text-xl font-bold mb-3 nvidia-green">{{ $blog->title }}</h3>
                            <p class="text-gray-300 mb-4">
                                {{ Str::limit($blog->description, 20) }}
                            </p>
                            @if ($blog->tags->count() > 0)
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach ($blog->tags as $tag)
                                        <span
                                            class="blog-tag px-3 py-1 rounded-full text-xs font-medium bg-gray-700 text-gray-200 hover:bg-gray-600 transition-all"
                                            data-tag="{{ strtolower($tag->name) }}">
                                            {{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-400">
                                <i class="fas fa-calendar mr-1"></i>
                                {{ $blog->created_at->format('d M Y g:i A') }}
                            </span>
                            <div class="flex items-center gap-3">
                                @can('edit', $blog)
                                    <a href="/blogs/{{ $blog->id }}/edit"
                                        class=" hover:text-green-400 text-sm p-2 rounded-full hover:bg-gray-700 transition-colors">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                                <a href="/blogs/{{ $blog->id }}"
                                    class="text-green-500 hover:text-green-400 text-sm font-semibold transition-all flex items-center gap-1">
                                    Read More <i class="fas fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>
            <div class="text-center mt-12">
            <a href="{{ route('blogs.blog') }}"
               class="inline-flex items-center gap-2 text-green-400 hover:text-white border border-green-400 hover:bg-green-500 hover:border-transparent px-6 py-3 rounded-full transition duration-300 text-lg font-medium">
                View All Blogs
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-gray-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl sm:text-5xl font-bold mb-6 nvidia-green">About NVIDIA</h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                    Leading the way in visual computing and artificial intelligence innovation
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- About Card 1 -->
                <div class="bg-gray-900 rounded-xl p-8 text-center card-hover">
                    <div class="w-16 h-16 nvidia-green-bg rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-brain text-2xl text-black"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 nvidia-green">AI Innovation</h3>
                    <p class="text-gray-300 leading-relaxed">
                        Pioneering artificial intelligence technologies that accelerate scientific discovery,
                        enhance creative workflows, and power the next generation of intelligent applications.
                    </p>
                </div>

                <!-- About Card 2 -->
                <div class="bg-gray-900 rounded-xl p-8 text-center card-hover">
                    <div class="w-16 h-16 nvidia-green-bg rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-gamepad text-2xl text-black"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 nvidia-green">Gaming Excellence</h3>
                    <p class="text-gray-300 leading-relaxed">
                        Delivering unparalleled gaming experiences with cutting-edge graphics processing,
                        real-time ray tracing, and AI-enhanced performance optimization.
                    </p>
                </div>
            </div>

            <!-- About Card 3 (Full Width) -->
            <div class="bg-gray-900 rounded-xl p-8 text-center card-hover">
                <div class="w-16 h-16 nvidia-green-bg rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-rocket text-2xl text-black"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4 nvidia-green">Future Technology</h3>
                <p class="text-gray-300 leading-relaxed max-w-4xl mx-auto">
                    Shaping the future of computing with revolutionary technologies in autonomous vehicles,
                    data centers, edge computing, and the metaverse. We're building the infrastructure
                    for tomorrow's digital world.
                </p>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-20 bg-gradient-to-r from-green-600 to-green-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl sm:text-5xl font-bold mb-6 text-black">Ready to Explore?</h2>
            <p class="text-xl text-gray-900 mb-8 max-w-2xl mx-auto">
                Join thousands of developers, researchers, and enthusiasts who stay updated with our latest content.
            </p>
            <a href="{{ route('blogs.blog') }}"
                class="inline-flex items-center px-10 py-5 bg-black text-green-500 font-bold text-lg rounded-lg hover-scale transition-all duration-300">
                <i class="fas fa-book-open mr-3"></i>
                Start Reading
            </a>
        </div>
    </section>
@endsection
