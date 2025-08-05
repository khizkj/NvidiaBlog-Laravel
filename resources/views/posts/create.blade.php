@extends('components.layout')

@section('title', 'Create New Post - Nvidia Blog')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-16 bg-gradient-to-br from-gray-900 via-gray-800 to-green-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl sm:text-5xl font-bold mb-4 nvidia-green">Create New Post</h1>
                <p class="text-lg text-gray-300 max-w-2xl mx-auto">
                    Share your knowledge and insights with the NVIDIA community
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

    <!-- Create Post Form -->
    <section class="py-16 bg-gray-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <form class="space-y-8" method="POST" action="/blogs" enctype="multipart/form-data">
                    @csrf
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
                                    Author's Name
                                </label>
                                <input type="text" id="Author" name="Author" rows="3"
                                    placeholder="Enter your name"
                                    class="w-full px-6 py-4 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-white placeholder-gray-400 resize-none transition-all duration-300"
                                    required></input>
                            </div>
                            @error('Author')
                                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                            <div>
                                <label for="title" class="block text-sm font-semibold text-gray-300 mb-3">
                                    Post Title
                                </label>
                                <input type="text" id="title" name="title"
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
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 nvidia-green-bg rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-edit text-black"></i>
                            </div>
                            <h2 class="text-2xl font-bold nvidia-green">Content</h2>
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-semibold text-gray-300 mb-3">
                                Post Content
                            </label>
                            <div class="relative">
                                <!-- Toolbar -->

                                <textarea id="description" name="description" rows="12"
                                    placeholder="Write your post content here. You can use markdown or HTML..."
                                    class="w-full px-6 py-4 bg-gray-700 border border-gray-600 rounded-b-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-white placeholder-gray-400 resize-none transition-all duration-300"
                                    required></textarea>
                            </div>
                            @error('description')
                                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror

                        </div>
                    </div>

                    <!-- Categories and Tags -->
                    <div class="bg-gray-800 rounded-xl p-8 card-hover">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 nvidia-green-bg rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-tags text-black"></i>
                            </div>
                            <h2 class="text-2xl font-bold nvidia-green">Tags</h2>
                        </div>

                        {{-- Existing Tags --}}
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-300 mb-3">
                                Choose Tags
                            </label>
                            @if ($tags->isEmpty())
                                <p class="text-sm text-gray-400">No tags available.</p>
                            @else
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($tags as $tag)
                                        <label
                                            class="inline-flex items-center bg-gray-700 px-3 py-2 rounded-lg text-sm text-white cursor-pointer">
                                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                                class="tag-checkbox mr-2" data-name="{{ $tag->name }}">
                                            {{ $tag->name }}
                                        </label>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        {{-- Live Selected Tags Display --}}
                        <div id="selected-tags-display" class="mt-4">
                            <p class="text-sm font-semibold text-gray-300 mb-2">Selected Tags:</p>
                            <div id="selected-tags-list" class="flex flex-wrap gap-2 text-white"></div>
                        </div>
                    </div>
                    <!-- Featured Image -->
                    <div class="bg-gray-700 rounded-lg p-4" id="image-preview-box">
                        <div class="flex items-center justify-between mb-3">
                            <p class="text-sm font-semibold text-gray-300">Current Featured Image</p>
                            <button type="button" class="text-red-400 hover:text-red-300 text-sm"
                                onclick="removeImagePreview()">
                                <i class="fas fa-trash mr-1"></i>Remove
                            </button>
                        </div>

                        <div class="w-full h-32 bg-gray-800 rounded-lg flex items-center justify-center overflow-hidden">
                            <img id="preview-image" src="{{ $blog->image ? asset('storage/' . $blog->image) : '' }}"
                                alt="Current Image"
                                class="object-cover h-full w-full rounded-md shadow {{ $blog->image ? '' : 'hidden' }}" />

                            <i id="preview-icon"
                                class="fas fa-robot text-4xl text-white {{ $blog->image ? 'hidden' : '' }}"></i>
                        </div>

                        <p class="text-xs text-gray-400 mt-2" id="image-name">
                            {{ $blog->image ? basename($blog->image) : 'No image selected' }}
                        </p>

                        <input type="hidden" id="remove_image_flag" name="remove_image" value="0">
                    </div>

                    <!-- Upload New Image -->
                    <div
                        class="border-2 border-dashed border-gray-600 rounded-lg p-6 text-center hover:border-green-500 transition-colors duration-300">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-3"></i>
                            <p class="text-gray-300 mb-2">Upload new image</p>
                            <p class="text-sm text-gray-500">Supports: JPG, PNG, GIF (Max: 5MB)</p>

                            <input type="file" id="image" name="image" accept="image/*" class="hidden">
                            <button type="button" onclick="document.getElementById('image').click()"
                                class="mt-3 px-4 py-2 nvidia-green-bg text-black font-semibold rounded-lg hover-scale transition-all duration-300">
                                Choose New File
                            </button>
                        </div>
                    </div>

                    @error('image')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror

                    <!-- JavaScript -->

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const checkboxes = document.querySelectorAll('.tag-checkbox');
                            const tagList = document.getElementById('selected-tags-list');

                            function updateSelectedTags() {
                                tagList.innerHTML = ''; // clear existing
                                checkboxes.forEach(cb => {
                                    if (cb.checked) {
                                        const span = document.createElement('span');
                                        span.textContent = cb.dataset.name;
                                        span.className = 'bg-green-600 px-3 py-1 rounded-lg text-sm';
                                        tagList.appendChild(span);
                                    }
                                });
                            }

                            checkboxes.forEach(cb => {
                                cb.addEventListener('change', updateSelectedTags);
                            });

                            // Initialize on load in case of old input
                            updateSelectedTags();
                        });


                        const imageInput = document.getElementById('image');
                        const previewImage = document.getElementById('preview-image');
                        const previewIcon = document.getElementById('preview-icon');
                        const imageName = document.getElementById('image-name');
                        const removeFlag = document.getElementById('remove_image_flag');

                        imageInput.addEventListener('change', function() {
                            const file = this.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    previewImage.src = e.target.result;
                                    previewImage.classList.remove('hidden');
                                    previewIcon.classList.add('hidden');
                                    imageName.textContent = file.name;
                                    removeFlag.value = "0";
                                }
                                reader.readAsDataURL(file);
                            }
                        });

                        function removeImagePreview() {
                            previewImage.src = '';
                            previewImage.classList.add('hidden');
                            previewIcon.classList.remove('hidden');
                            imageInput.value = '';
                            imageName.textContent = 'No image selected';
                            removeFlag.value = "1";
                        }
                    </script>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-end">
                        <button type="submit"
                            class="px-8 py-4 nvidia-green-bg text-black font-bold rounded-lg hover-scale glow-effect transition-all duration-300">
                            <i class="fas fa-rocket mr-2"></i>
                            Publish Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
