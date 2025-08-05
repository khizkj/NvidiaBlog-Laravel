@extends('components.layout')

@section('title', 'Post Title - Nvidia Blog')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-12 sm:py-20 bg-gradient-to-br from-gray-900 via-gray-800 to-green-900">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-2xl sm:text-4xl md:text-5xl font-bold mb-4 sm:mb-6 nvidia-green leading-tight">
                {{ $blog->title }}
            </h1>
        </div>

        <!-- Enhanced Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-10 left-6 w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-3 h-3 bg-green-400 rounded-full animate-ping"></div>
            <div class="absolute top-1/2 left-1/4 w-1 h-1 bg-green-300 rounded-full animate-pulse delay-300"></div>
            <div class="absolute bottom-1/3 left-3/4 w-2 h-2 bg-green-600 rounded-full animate-ping delay-700"></div>
        </div>
    </section>

    <!-- Blog Content -->
    <section class="py-10 sm:py-16 bg-gray-900">
        <div class="container mx-auto px-4 max-w-4xl text-white">

            <!-- Back Button -->
            <div class="mb-5 sm:mb-8">
                <a href="/blogs"
                    class="inline-flex items-center gap-2 text-green-400 hover:text-white border border-green-400 hover:bg-green-500 hover:border-transparent px-4 py-2 rounded-full transition-all duration-300 text-sm sm:text-base shadow-lg hover:shadow-green-500/25">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Posts
                </a>
            </div>

            <!-- Meta Info -->
            <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl p-4 sm:p-6 mb-8 border border-gray-700/50">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-sm text-gray-300 gap-4">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                {{ substr($blog->Author, 0, 1) }}
                            </div>
                            <span>By <span class="text-green-400 font-semibold">{{ $blog->Author }}</span></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ $blog->created_at->format('d M Y g:i A') }}</span>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($blog->tags as $tag)
                            <span class="px-3 py-1 rounded-full bg-gradient-to-r from-green-600/20 to-green-500/20 border border-green-500/30 text-green-400 text-xs font-medium hover:shadow-md hover:shadow-green-500/20 transition-all duration-300 hover:scale-105">
                                #{{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Image -->
            <div class="mb-8 sm:mb-12 rounded-xl overflow-hidden shadow-2xl relative group">
                <img src="{{ asset('storage/' . $blog->image) }}"
                    class="w-full object-cover h-52 sm:h-[400px] md:h-[600px] rounded-xl transition-transform duration-500 group-hover:scale-105"
                    alt="{{ $blog->title }}">
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl"></div>
            </div>

            <!-- Article Content Section -->
            <div class="bg-gray-800/30 backdrop-blur-sm rounded-xl p-6 sm:p-8 mb-12 border border-gray-700/30">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-1 h-8 bg-gradient-to-b from-green-400 to-green-600 rounded-full"></div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-green-400">Article Content</h2>
                </div>

                <!-- Article Body -->
                <article class="prose prose-invert prose-lg max-w-none text-gray-200 leading-relaxed">
                    <div class="text-lg leading-8 space-y-4">
                        {!! nl2br(e($blog->description)) !!}
                    </div>
                </article>
            </div>

            <!-- Enhanced Comment Section -->
            <section class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl shadow-2xl border border-gray-700/50 overflow-hidden">
                <!-- Comment Header -->
                <div class="bg-gradient-to-r from-green-600/10 to-green-500/10 border-b border-gray-700/50 p-6 sm:p-8">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-green-500/20 rounded-xl border border-green-500/30">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl sm:text-3xl font-bold text-green-400">Discussion</h2>
                            <p class="text-gray-400 mt-1">Join the conversation and share your thoughts</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 sm:p-8">
                    @auth
                        <!-- Comment Form -->
                        <div class="bg-gray-800/50 rounded-xl p-6 mb-8 border border-gray-700/30">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                    {{ substr(auth()->user()->full_name, 0, 1) }}
                                </div>
                                <span class="text-green-400 font-medium">{{ auth()->user()->full_name}}</span>
                            </div>

                            <form action="{{ route('comments.store', $blog->id) }}" method="POST">
                                @csrf
                                <textarea name="body" rows="4"
                                    class="w-full p-4 rounded-xl bg-gray-900/50 border border-gray-600/50 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500/50 transition-all duration-300 resize-none"
                                    placeholder="Share your thoughts about this article..." required></textarea>
                                <div class="flex justify-end mt-4">
                                    <button type="submit"
                                        class="px-6 py-3 bg-gradient-to-r from-green-600 to-green-500 hover:from-green-500 hover:to-green-400 rounded-xl text-white font-semibold transition-all duration-300 shadow-lg hover:shadow-green-500/25 transform hover:scale-105 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                        </svg>
                                        Post Comment
                                    </button>
                                </div>
                            </form>
                        </div>
                    @else
                        <!-- Login Prompt -->
                        <div class="bg-gradient-to-r from-gray-800/50 to-gray-700/50 rounded-xl p-6 mb-8 border border-gray-600/30 text-center">
                            <div class="flex flex-col items-center gap-4">
                                <div class="w-16 h-16 bg-green-500/20 rounded-full flex items-center justify-center border border-green-500/30">
                                    <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-300 text-lg mb-2">Join the Discussion</p>
                                    <p class="text-gray-400">Please <a href="/login" class="text-green-400 underline hover:text-green-300 font-semibold transition-colors">log in</a> to share your thoughts and engage with the community.</p>
                                </div>
                            </div>
                        </div>
                    @endauth

                    <!-- Comments List -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 mb-6">
                            <h3 class="text-xl font-semibold text-green-300">
                                Comments ({{ $blog->comments->count() }})
                            </h3>
                            <div class="flex-1 h-px bg-gradient-to-r from-green-500/30 to-transparent"></div>
                        </div>

                        @forelse ($blog->comments as $comment)
                            <div class="bg-gray-800/30 rounded-xl p-6 border-l-4 border-green-500/50 hover:bg-gray-800/50 transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center text-white font-semibold flex-shrink-0">
                                        {{ substr($comment->user->full_name, 0, 1) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-2">
                                            <div class="flex items-center gap-3">
                                                <h4 class="text-green-400 font-semibold">{{ $comment->user->full_name}}</h4>
                                                <span class="text-sm text-gray-500">{{ strtolower(str_replace(' ', '', $comment->user->full_name)) }}</span>
                                                <div class="flex items-center gap-2 text-gray-500 text-sm">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    {{ $comment->created_at->diffForHumans() }}
                                                </div>
                                            </div>

                                            @auth
                                                @if(auth()->user()->id === $comment->user_id)
                                                    <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                        <!-- Edit Button -->
                                                        <button onclick="toggleEdit({{ $comment->id }})"
                                                                class="p-2 text-gray-400 hover:text-green-400 hover:bg-green-500/10 rounded-lg transition-all duration-200">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                            </svg>
                                                        </button>

                                                        <!-- Delete Button -->
                                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="inline"
                                                              onsubmit="return confirm('Are you sure you want to delete this comment?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="p-2 text-gray-400 hover:text-red-400 hover:bg-red-500/10 rounded-lg transition-all duration-200">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>

                                        <!-- Comment Text -->
                                        <div id="comment-text-{{ $comment->id }}">
                                            <p class="text-gray-200 leading-relaxed">{{ $comment->body }}</p>
                                        </div>

                                        <!-- Edit Form (Hidden by default) -->
                                        <div id="comment-edit-{{ $comment->id }}" class="hidden">
                                            <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <textarea name="body" rows="3"
                                                          class="w-full p-3 rounded-lg bg-gray-900/50 border border-gray-600/50 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500/50 transition-all duration-300 resize-none mb-3">{{ $comment->body }}</textarea>
                                                <div class="flex items-center gap-3">
                                                    <button type="submit"
                                                            class="px-4 py-2 bg-green-600 hover:bg-green-500 text-white rounded-lg font-medium transition-all duration-200 text-sm">
                                                        Save Changes
                                                    </button>
                                                    <button type="button" onclick="toggleEdit({{ $comment->id }})"
                                                            class="px-4 py-2 bg-gray-600 hover:bg-gray-500 text-white rounded-lg font-medium transition-all duration-200 text-sm">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <div class="w-20 h-20 bg-gray-800/50 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-700/50">
                                    <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-xl font-semibold text-gray-400 mb-2">No comments yet</h4>
                                <p class="text-gray-500">Be the first to start the conversation!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>
        </div>
    </section>

    <script>
        function toggleEdit(commentId) {
            const textDiv = document.getElementById(`comment-text-${commentId}`);
            const editDiv = document.getElementById(`comment-edit-${commentId}`);

            if (textDiv.classList.contains('hidden')) {
                // Show text, hide edit form
                textDiv.classList.remove('hidden');
                editDiv.classList.add('hidden');
            } else {
                // Hide text, show edit form
                textDiv.classList.add('hidden');
                editDiv.classList.remove('hidden');
            }
        }
    </script>
@endsection
