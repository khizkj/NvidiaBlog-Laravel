@extends('components.layout')

@section('title', 'Your Blog Posts - Nvidia Blog')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-br from-gray-900 via-gray-800 to-green-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-5xl sm:text-6xl font-bold mb-6 nvidia-green">Your Blog Posts</h1>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                    These Are all the blogs you have posted thus far.
                </p>
            </div>
        </div>

        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 left-10 w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            <div class="absolute top-40 right-20 w-1 h-1 bg-green-400 rounded-full animate-ping"></div>
            <div class="absolute bottom-20 left-1/4 w-3 h-3 bg-green-300 rounded-full animate-bounce"></div>
        </div>
    </section>

    <!-- Search and Filter Section -->
    <section class="py-6 bg-gray-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Search articles..."
                        class="w-full px-6 py-4 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent -100 ">
                    <div class="absolute inset-y-0 right-0 pr-6 flex items-center">
                        <i class="fas fa-search -400"></i>
                    </div>
                </div>
            </div>

            <!-- Filter Tags -->
            <div class="flex flex-wrap justify-center gap-3 mt-5" id="tagFilters">
                <button data-tag="all"
                    class="tag-filter px-4 py-2 rounded-full font-medium transition-all nvidia-green-bg text-black hover-scale active">
                    All
                </button>
                @foreach ($tags as $tag)
                    <button data-tag="{{ strtolower($tag->name) }}"
                        class="tag-filter px-4 py-2 rounded-full font-medium transition-all bg-gray-700 -200 hover:bg-gray-600">
                        {{ $tag->name }}
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Blog Posts Section -->
    <section class="py-10 bg-gray-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Action Buttons -->
            <div class="flex justify-between items-center mb-5">
                <a href="/blogs/create"
                    class="inline-flex items-center gap-2 text-green-400 hover:text-white border border-green-400 hover:bg-green-500 hover:border-transparent px-4 py-2 rounded-full transition duration-300">
                    <i class="fas fa-plus"></i>
                    Add Post
                </a>
                @auth
                    <a href="/blogs"
                        class="inline-flex items-center gap-2 text-green-400 hover:text-white border border-green-400 hover:bg-green-500 hover:border-transparent px-4 py-2 rounded-full transition duration-300">
                        <i class="fas fa-list"></i>
                        All Posts
                    </a>
                @endauth

            </div>

            <!-- Blog Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Featured Blog 1 -->
                @foreach ($blogs as $blog)
                    <div class="bg-gray-800 rounded-xl overflow-hidden card-hover blog-card"
                        data-tags="{{ $blog->tags->pluck('name')->map(fn($tag) => strtolower($tag))->join(',') }}"
                        data-title="{{ strtolower($blog->title) }}" data-description="{{ strtolower($blog->description) }}">
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
        </div>


        <!-- Pagination Wrapper -->
        <div class="mt-10 flex flex-col items-center space-y-4" id="paginationWrapper">
            <div class="flex space-x-2">
                {{ $blogs->onEachSide(1)->links('vendor.pagination.nvidia') }}
            </div>
            <div class="-200 text-sm" id="resultsCount">
                Showing {{ $blogs->firstItem() }} to {{ $blogs->lastItem() }} of {{ $blogs->total() }} results
            </div>
        </div>
        <div id="noResults" class="hidden -200 text-center text-sm mt-6">No matching articles found.</div>
        </div>
    </section>

   <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const tagFilters = document.querySelectorAll('.tag-filter');
            const blogCards = document.querySelectorAll('.blog-card');
            const noResults = document.getElementById('noResults');
            const resultsCount = document.getElementById('resultsCount');
            const paginationWrapper = document.getElementById('paginationWrapper');

            let currentTag = 'all';
            let currentSearch = '';

            // Search filtering
            searchInput.addEventListener('input', function() {
                currentSearch = this.value.toLowerCase();
                filterBlogPosts();
                highlightMatchingTags(currentTag);
            });

            // Tag filtering
            tagFilters.forEach(filter => {
                filter.addEventListener('click', function() {
                    const tagName = this.getAttribute('data-tag');
                    if (tagName === currentTag) return;

                    currentTag = tagName;

                    // Reset all tag styles
                    tagFilters.forEach(f => {
                        f.classList.remove('nvidia-green-bg', 'text-black', 'hover-scale',
                            'active');
                        f.classList.add('bg-gray-700', '-200', 'hover:bg-gray-600');
                    });

                    // Highlight current tag
                    this.classList.remove('bg-gray-700', '-200', 'hover:bg-gray-600');
                    this.classList.add('nvidia-green-bg', 'text-black', 'hover-scale', 'active');

                    filterBlogPosts();
                    highlightMatchingTags(currentTag); // ✅ called here too
                });
            });

            function filterBlogPosts() {
                let visibleCount = 0;

                blogCards.forEach(card => {
                    const cardTags = card.getAttribute('data-tags').split(',');
                    const cardTitle = card.getAttribute('data-title');
                    const cardDescription = card.getAttribute('data-description');

                    const matchesTag = currentTag === 'all' || cardTags.includes(currentTag);
                    const matchesSearch = currentSearch === '' ||
                        cardTitle.includes(currentSearch) ||
                        cardDescription.includes(currentSearch);

                    if (matchesTag && matchesSearch) {
                        card.style.display = 'block';
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(20px)';
                        setTimeout(() => {
                            card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, visibleCount * 50);
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Pagination display
                paginationWrapper.style.display = (currentTag !== 'all' || currentSearch !== '') ? 'none' : 'flex';

                // No results handling
                if (visibleCount === 0) {
                    noResults.style.display = 'block';
                    resultsCount.style.display = 'none';
                } else {
                    noResults.style.display = 'none';
                    resultsCount.style.display = 'block';
                    if (currentTag !== 'all' || currentSearch !== '') {
                        resultsCount.textContent =
                            `Showing ${visibleCount} filtered result${visibleCount > 1 ? 's' : ''}`;
                    } else {
                        resultsCount.textContent =
                            `Showing {{ $blogs->firstItem() }} to {{ $blogs->lastItem() }} of {{ $blogs->total() }} results`;
                    }
                }
            }

            function highlightMatchingTags(selectedTag) {
                const blogTags = document.querySelectorAll('.blog-tag');

                blogTags.forEach(tag => {
                    const tagName = tag.getAttribute('data-tag');
                    if (selectedTag === 'all') {
                        tag.classList.remove('nvidia-green-bg', 'text-black', 'active');
                        tag.classList.add('bg-gray-700', );
                    } else if (tagName === selectedTag) {
                        tag.classList.add('nvidia-green-bg', 'text-black', 'active');
                        tag.classList.remove('bg-gray-700', );
                    } else {
                        tag.classList.remove('nvidia-green-bg', 'text-black', 'active');
                        tag.classList.add('bg-gray-700', );
                    }
                });
            }

            // Initial card animation

        });
    </script>



@endsection
