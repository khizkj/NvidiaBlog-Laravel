@extends('components.layout')

@section('title', 'Edit Post - Nvidia Blog')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-16 bg-gradient-to-br from-gray-900 via-gray-800 to-green-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl sm:text-5xl font-bold mb-4 nvidia-green">Edit Post</h1>
                <p class="text-lg text-gray-300 max-w-2xl mx-auto">
                    Update Your Blog Post
                </p>
                <div class="flex items-center justify-center mt-4 text-sm text-gray-400">
                    <i class="fas fa-clock mr-2"></i>
                    Last modified: January 15, 2025 at 3:45 PM
                </div>
            </div>
        </div>

        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 left-10 w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            <div class="absolute top-40 right-20 w-1 h-1 bg-green-400 rounded-full animate-ping"></div>
            <div class="absolute bottom-20 left-1/4 w-3 h-3 bg-green-300 rounded-full animate-bounce"></div>
        </div>
    </section>

    <!-- Edit Post Form -->
    <section class="py-16 bg-gray-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Post Status Banner -->
                <div class="bg-green-500 bg-opacity-20 border border-green-500 rounded-xl p-4 mb-8 flex items-center">
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-check text-black text-sm"></i>
                    </div>
                    <div>
                        <p class="text-green-400 font-semibold">Published Post</p>
                        <p class="text-sm text-green-300">This post is currently live and visible to readers</p>
                    </div>
                </div>

                <form class="space-y-8" method="POST" action="/blogs/{{ $blog->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <!-- Post Title -->
                    <div class="bg-gray-800 rounded-xl p-8 card-hover">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 nvidia-green-bg rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-heading text-black"></i>
                            </div>
                            <h2 class="text-2xl font-bold nvidia-green">Post Details</h2>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label for="Author" class="block text-sm font-semibold text-gray-300 mb-3">
                                    Author
                                </label>
                                <input type="text" id="Author" name="Author"
                                    value="{{ old('Author', $blog->Author) }}"
                                    placeholder="Enter an engaging title for your post"
                                    class="w-full px-6 py-4 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-white placeholder-gray-400 transition-all duration-300"
                                    required>
                            </div>
                            @error('Author')
                                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror

                            <div>
                                <label for="excerpt" class="block text-sm font-semibold text-gray-300 mb-3">
                                    Title
                                </label>
                                <input type="text" id="title" name="title" value="{{ old('title', $blog->title) }}"
                                    placeholder="Enter an engaging title for your post"
                                    class="w-full px-6 py-4 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-white placeholder-gray-400 transition-all duration-300"
                                    required>
                            </div>
                            @error('title')
                                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="bg-gray-800 rounded-xl p-8 card-hover">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center">
                                <div class="w-10 h-10 nvidia-green-bg rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-edit text-black"></i>
                                </div>
                                <h2 class="text-2xl font-bold nvidia-green">Content</h2>
                            </div>
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-semibold text-gray-300 mb-3">
                                Post Content
                            </label>
                            <div class="relative">
                                <!-- Toolbar -->
                                <textarea id="description" name="description" rows="12" value="{{ $blog->description }}"
                                    placeholder="Write your post content here. You can use markdown or HTML..."
                                    class="w-full px-6 py-4 bg-gray-700 border border-gray-600 rounded-b-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-white placeholder-gray-400 resize-none transition-all duration-300"
                                    required>{{ old('description', $blog->description) }}</textarea>
                            </div>
                            @error('description')
                                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Categories and Tags -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Tags -->
                        <div class="bg-gray-800 rounded-xl p-8 card-hover">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 nvidia-green-bg rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-tags text-black"></i>
                                </div>
                                <h2 class="text-2xl font-bold nvidia-green">Tags</h2>
                            </div>

                            <!-- Existing Available Tags -->
                            <div class="mt-4">
                                @if ($allTags->count())
                                    <p class="text-sm text-gray-300 mb-2">Select from existing tags:</p>
                                    <div class="flex flex-wrap gap-3">
                                        @foreach ($allTags as $tag)
                                            <label class="inline-flex items-center text-white">
                                                <input type="checkbox" name="existing_tags[]" value="{{ $tag->id }}"
                                                    class="form-checkbox text-green-500 mr-2"
                                                    {{ in_array($tag->id, old('existing_tags', $selectedTagIds ?? [])) ? 'checked' : '' }}>
                                                {{ $tag->name }}
                                            </label>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-sm text-gray-400">No tags available</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <div class="bg-gray-800 rounded-xl p-8 card-hover">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 nvidia-green-bg rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-image text-black"></i>
                            </div>
                            <h2 class="text-2xl font-bold nvidia-green">Featured Image</h2>
                        </div>

                        <div class="space-y-4">
                            <!-- Current Image Preview -->
                            <div class="bg-gray-700 rounded-lg p-4" id="image-preview-box">
                                <div class="flex items-center justify-between mb-3">
                                    <p class="text-sm font-semibold text-gray-300">Current Featured Image</p>
                                    <button type="button" class="text-red-400 hover:text-red-300 text-sm"
                                        onclick="removeImagePreview()">
                                        <i class="fas fa-trash mr-1"></i>Remove
                                    </button>
                                </div>

                                <div
                                    class="w-full h-32 bg-gradient-to-br from-green-600 to-green-800 rounded-lg flex items-center justify-center overflow-hidden">
                                    @if ($blog->image)
                                        <img id="preview-image" src="{{ asset('storage/' . $blog->image) }}"
                                            alt="Current Image" class="object-cover h-full w-full rounded-md shadow" />
                                    @else
                                        <i class="fas fa-robot text-4xl text-white"></i>
                                    @endif
                                </div>

                                <p class="text-xs text-gray-400 mt-2">
                                    {{ basename($blog->image) }}
                                </p>

                                <!-- Hidden input to tell backend to keep or remove -->
                                <input type="hidden" id="remove_image_flag" name="remove_image" value="0">
                            </div>

                            <!-- Upload New Image -->
                            <div
                                class="border-2 border-dashed border-gray-600 rounded-lg p-6 text-center hover:border-green-500 transition-colors duration-300">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-3"></i>
                                    <p class="text-gray-300 mb-2">Upload new image</p>
                                    <p class="text-sm text-gray-500">Supports: JPG, PNG, GIF (Max: 5MB)</p>
                                    <input type="file" id="image" name="image" accept="image/*"
                                        class="hidden">
                                    <button type="button" onclick="document.getElementById('image').click()"
                                        class="mt-3 px-4 py-2 nvidia-green-bg text-black font-semibold rounded-lg hover-scale transition-all duration-300">
                                        Choose New File
                                    </button>
                                </div>

                            </div>
                            @error('image')
                                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <script>
                            function removeImagePreview() {
                                // Hide the entire image preview box
                                const previewBox = document.getElementById('image-preview-box');
                                if (previewBox) previewBox.style.display = 'none';

                                // Set a hidden input flag if you want to process this in the backend
                                const removeFlag = document.getElementById('remove_image_flag');
                                if (removeFlag) removeFlag.value = "1";
                            }
                        </script>
                    </div>

                    <!-- Action Buttons -->
                    <div
                        class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 pt-8 border-t border-gray-700">
                        <!-- Delete Button (separate form!) -->
                        <button form="form-delete"
                            class="px-6 py-3 border-2 border-red-500 text-red-500 font-semibold rounded-lg hover:bg-red-500 hover:text-white transition-all duration-300">
                            <i class="fas fa-trash mr-2"></i>
                            Delete Post
                        </button>
                        < <!-- Update Button (submit the surrounding update form) -->
                            <button type="submit"
                                class="px-8 py-3 nvidia-green-bg text-black font-bold rounded-lg hover-scale glow-effect transition-all duration-300">
                                <i class="fas fa-check mr-2"></i>
                                Update Post
                            </button>
                    </div>
            </div>
            </form>

            <form method="POST" id="form-delete" action="/blogs/{{ $blog->id }}" class="hidden">
                @csrf
                @method('DELETE')
            </form>

        </div>
        </div>
    </section>
@endsection
