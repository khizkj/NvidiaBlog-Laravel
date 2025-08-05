<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
        }

        .gradient-border {
            background: linear-gradient(135deg, #ffffff, #f3f4f6);
            padding: 2px;
            border-radius: 16px;
        }

        .gradient-border-content {
            background: #000000;
            border-radius: 14px;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-in {
            animation: slideIn 0.6s ease-out forwards;
            opacity: 0;
        }

        .animate-delay-100 {
            animation-delay: 0.1s;
        }

        .animate-delay-200 {
            animation-delay: 0.2s;
        }

        .animate-delay-300 {
            animation-delay: 0.3s;
        }

        .animate-delay-400 {
            animation-delay: 0.4s;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #1a1a1a;
        }

        ::-webkit-scrollbar-thumb {
            background: #404040;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #606060;
        }
    </style>
</head>

<body class="bg-black text-white min-h-screen">
    <!-- Header -->
    <header class="bg-gray-900 border-b border-gray-800 px-6 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <h1 class="text-3xl font-bold text-white">Admin Dashboard</h1>
            </div>

            <div class="flex items-center space-x-4">

                <!-- User Menu -->
                <div class="relative">
                    <a  class="flex items-center space-x-2 text-gray-300 hover:text-white transition-colors duration-200" href="/">

                        <div
                            class="w-8 h-8 bg-white text-black rounded-full flex items-center justify-center font-semibold">
                            H
                        </div>
                        <span>Return Home</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="p-6">
        <!-- Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Total Blog Posts -->
            <div class="gradient-border animate-slide-in">
                <div class="gradient-border-content p-6 card-hover">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm font-medium uppercase tracking-wider">Total Blog Posts</p>
                            <p class="text-3xl font-bold text-white mt-2">{{ $totalblog }}</p>
                            <p class="text-gray-500 text-xs mt-1">
                                <span class="text-green-400">+12%</span> from last month
                            </p>
                        </div>
                        <div class="bg-white bg-opacity-10 rounded-full p-4">
                            <i class="fas fa-blog text-2xl text-white"></i>
                        </div>
                    </div>
                    <div class="mt-4 bg-gray-800 rounded-full h-2">
                        <div class="bg-white rounded-full h-2 w-3/4 transition-all duration-300"></div>
                    </div>
                </div>
            </div>

            <!-- Total Users -->
            <div class="gradient-border animate-slide-in animate-delay-100">
                <div class="gradient-border-content p-6 card-hover">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm font-medium uppercase tracking-wider">Total Users</p>
                            <p class="text-3xl font-bold text-white mt-2">{{ $totaluser }}</p>
                            <p class="text-gray-500 text-xs mt-1">
                                <span class="text-green-400">+8%</span> from last month
                            </p>
                        </div>
                        <div class="bg-white bg-opacity-10 rounded-full p-4">
                            <i class="fas fa-users text-2xl text-white"></i>
                        </div>
                    </div>
                    <div class="mt-4 bg-gray-800 rounded-full h-2">
                        <div class="bg-white rounded-full h-2 w-2/3 transition-all duration-300"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table Section -->
        <div class="gradient-border animate-slide-in animate-delay-200 mb-8">
            <div class="gradient-border-content overflow-hidden">
                <div class="p-6 border-b border-gray-800">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-users mr-3"></i>
                            All Users
                        </h2>
                        <div class="flex items-center space-x-3">
                            <div class="relative">
                                <input type="text" placeholder="Search users..."
                                    class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 pl-10 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent transition-all duration-200">
                                <i
                                    class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-800">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        User
                                        <i class="fas fa-sort ml-2 text-gray-500"></i>
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        Email
                                        <i class="fas fa-sort ml-2 text-gray-500"></i>
                                    </div>
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        Joined
                                        <i class="fas fa-sort ml-2 text-gray-500"></i>
                                    </div>
                                </th>

                                <th
                                    class="px-6 py-4 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Delete Users</th>
                            </tr>
                        </thead>
                       @foreach ($users as $user )
                        <tbody class="divide-y divide-gray-800">
                            <!-- Sample User 1 -->
                            <tr class="hover:bg-gray-800 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 bg-white text-black rounded-full flex items-center justify-center font-semibold mr-4">
                                            {{ substr($user->full_name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-white">{{ $user->full_name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-white">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    {{ $user->created_at->format('d M Y g:i A') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <form action="/admin/users/{{ $user->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="text-gray-400 hover:text-red-400 p-2 rounded-lg hover:bg-gray-700 transition-all duration-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

              <div class="px-6 py-4 border-t border-gray-800 flex items-center justify-between">
    <div class="text-sm text-gray-400">
        Showing
        <span class="font-medium text-white">{{ $users->firstItem() }}</span>
        to
        <span class="font-medium text-white">{{ $users->lastItem() }}</span>
        of
        <span class="font-medium text-white">{{ $users->total() }}</span>
        results
    </div>

    <div class="flex items-center space-x-2">
        {{-- Previous --}}
        @if ($users->onFirstPage())
            <span class="px-3 py-2 text-sm text-gray-500 border border-gray-700 rounded-lg cursor-not-allowed">Previous</span>
        @else
            <a href="{{ $users->previousPageUrl() }}"
               class="px-3 py-2 text-sm text-gray-400 hover:text-white border border-gray-700 rounded-lg hover:bg-gray-700 transition-all duration-200">Previous</a>
        @endif

        {{-- Page numbers --}}
        @for ($i = 1; $i <= $users->lastPage(); $i++)
            <a href="{{ $users->url($i) }}"
               class="px-3 py-2 text-sm rounded-lg font-medium
               {{ $users->currentPage() == $i
                   ? 'bg-white text-black'
                   : 'text-gray-400 hover:text-white border border-gray-700 hover:bg-gray-700 transition-all duration-200' }}">
               {{ $i }}
            </a>
        @endfor

        {{-- Next --}}
        @if ($users->hasMorePages())
            <a href="{{ $users->nextPageUrl() }}"
               class="px-3 py-2 text-sm text-gray-400 hover:text-white border border-gray-700 rounded-lg hover:bg-gray-700 transition-all duration-200">Next</a>
        @else
            <span class="px-3 py-2 text-sm text-gray-500 border border-gray-700 rounded-lg cursor-not-allowed">Next</span>
        @endif
    </div>
</div>
</div>

        <!-- Add Tags Section -->
        <div class="gradient-border animate-slide-in animate-delay-300">
            <div class="gradient-border-content p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-tags mr-3"></i>
                        Manage Tags
                    </h2>
                </div>

                <!-- Add New Tag Form -->
                <div class="bg-gray-800 rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold text-white mb-4">Add New Tag</h3>
                    <form action="/admin" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="tag_name" class="block text-sm font-medium text-gray-300 mb-2">Tag
                                    Name</label>
                                <input type="text" id="tag_name" name="name" placeholder="Enter tag name"
                                    class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent transition-all duration-200"
                                    required>
                            </div>
                        </div>
                        <div>
                            <label for="tag_description"
                                class="block text-sm font-medium text-gray-300 mb-2">Description (Optional)</label>
                            <textarea id="tag_description" name="description" rows="3" placeholder="Enter tag description"
                                class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent transition-all duration-200 resize-none"></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-white text-black px-6 py-3 rounded-lg font-semibold hover:bg-gray-200 transition-all duration-200 flex items-center">
                                <i class="fas fa-plus mr-2"></i>
                                Add Tag
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Existing Tags -->
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Existing Tags</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                        @foreach ($getTag as $tags)
                            <div class="bg-gray-800 rounded-lg p-4 hover:bg-gray-700 transition-all duration-200 group tag-card"
                                data-id="{{ $tags->id }}">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                        <span class="text-white font-medium tag-name">{{ $tags->name }}</span>
                                        <input type="text"
                                            class="hidden bg-gray-700 text-white px-2 py-1 rounded border border-gray-600 focus:border-blue-500 focus:outline-none tag-name-input"
                                            value="{{ $tags->name }}">
                                    </div>
                                    <div
                                        class="flex items-center space-x-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        <button
                                            class="text-gray-400 hover:text-white p-1 rounded edit-tag-btn transition-colors">
                                            <i class="fas fa-edit text-xs"></i>
                                        </button>
                                        <button
                                            class="text-green-400 hover:text-green-600 p-1 rounded hidden save-tag-btn transition-colors">
                                            <i class="fas fa-check text-xs"></i>
                                        </button>
                                        <button
                                            class="text-gray-400 hover:text-red-400 p-1 rounded hidden cancel-tag-btn transition-colors">
                                            <i class="fas fa-times text-xs"></i>
                                        </button>
                                        <form action="/admin/tags/{{ $tags->id }}" method="POST"
                                            class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-gray-400 hover:text-red-400 p-1 rounded transition-colors">
                                                <i class="fas fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <p class="text-gray-400 text-sm tag-description">{{ $tags->description }}</p>
                                    <textarea
                                        class="hidden w-full bg-gray-700 text-white p-2 rounded border border-gray-600 focus:border-blue-500 focus:outline-none tag-description-input min-h-[60px] resize-y">{{ $tags->description }}</textarea>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <style>
                    .tag-card {
                        border: 2px solid transparent;
                        transition: all 0.2s ease;
                    }

                    .tag-card.editing {
                        border-color: #3b82f6;
                        background-color: #374151 !important;
                    }

                    .tag-name-input:focus,
                    .tag-description-input:focus {
                        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
                    }

                    button:hover {
                        transform: scale(1.05);
                    }
                </style>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Edit functionality
                        document.querySelectorAll('.edit-tag-btn').forEach(function(editBtn) {
                            editBtn.addEventListener('click', function() {
                                const card = this.closest('[data-id]');
                                enterEditMode(card);
                            });
                        });

                        // Save functionality
                        document.querySelectorAll('.save-tag-btn').forEach(function(saveBtn) {
                            saveBtn.addEventListener('click', function() {
                                const card = this.closest('[data-id]');
                                const tagId = card.dataset.id;
                                const newName = card.querySelector('.tag-name-input').value.trim();
                                const newDescription = card.querySelector('.tag-description-input').value
                            .trim();

                                if (!newName) {
                                    alert('Tag name cannot be empty!');
                                    return;
                                }

                                // Show loading state
                                this.innerHTML = '<i class="fas fa-spinner fa-spin text-xs"></i>';
                                this.disabled = true;

                                // Fixed: Use dynamic tagId instead of hardcoded Laravel variable
                                fetch(`/admin/${tagId}`, {
                                        method: 'PUT',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({
                                            name: newName,
                                            description: newDescription
                                        })
                                    })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Network response was not ok');
                                        }
                                        return response.json();
                                    })
                                    .then(data => {
                                        // Update the display
                                        card.querySelector('.tag-name').textContent = newName;
                                        card.querySelector('.tag-description').textContent = newDescription;

                                        exitEditMode(card);

                                        // Show success feedback
                                        this.innerHTML = '<i class="fas fa-check text-xs"></i>';
                                        this.style.color = '#10b981';
                                        setTimeout(() => {
                                            this.style.color = '';
                                            this.disabled = false;
                                        }, 1000);
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        alert('Update failed! Please try again.');

                                        // Reset button
                                        this.innerHTML = '<i class="fas fa-check text-xs"></i>';
                                        this.disabled = false;
                                    });
                            });
                        });

                        // Cancel functionality
                        document.querySelectorAll('.cancel-tag-btn').forEach(function(cancelBtn) {
                            cancelBtn.addEventListener('click', function() {
                                const card = this.closest('[data-id]');

                                // Reset input values to original
                                const originalName = card.querySelector('.tag-name').textContent;
                                const originalDescription = card.querySelector('.tag-description').textContent;
                                card.querySelector('.tag-name-input').value = originalName;
                                card.querySelector('.tag-description-input').value = originalDescription;

                                exitEditMode(card);
                            });
                        });


                        function enterEditMode(card) {
                            card.classList.add('editing');

                            // Hide static elements
                            card.querySelector('.tag-name').classList.add('hidden');
                            card.querySelector('.tag-description').classList.add('hidden');
                            card.querySelector('.edit-tag-btn').classList.add('hidden');

                            // Show input elements
                            card.querySelector('.tag-name-input').classList.remove('hidden');
                            card.querySelector('.tag-description-input').classList.remove('hidden');
                            card.querySelector('.save-tag-btn').classList.remove('hidden');
                            card.querySelector('.cancel-tag-btn').classList.remove('hidden');

                            // Focus on name input
                            const nameInput = card.querySelector('.tag-name-input');
                            nameInput.focus();
                            nameInput.select();
                        }

                        function exitEditMode(card) {
                            card.classList.remove('editing');

                            // Show static elements
                            card.querySelector('.tag-name').classList.remove('hidden');
                            card.querySelector('.tag-description').classList.remove('hidden');
                            card.querySelector('.edit-tag-btn').classList.remove('hidden');

                            // Hide input elements
                            card.querySelector('.tag-name-input').classList.add('hidden');
                            card.querySelector('.tag-description-input').classList.add('hidden');
                            card.querySelector('.save-tag-btn').classList.add('hidden');
                            card.querySelector('.cancel-tag-btn').classList.add('hidden');
                        }

                        // Handle keyboard shortcuts
                        document.addEventListener('keydown', function(e) {
                            const activeCard = document.querySelector('.tag-card.editing');
                            if (activeCard) {
                                if (e.key === 'Enter' && !e.shiftKey && e.target.tagName !== 'TEXTAREA') {
                                    e.preventDefault();
                                    activeCard.querySelector('.save-tag-btn').click();
                                } else if (e.key === 'Escape') {
                                    activeCard.querySelector('.cancel-tag-btn').click();
                                }
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </main>

    <script>
        // Animation triggers on page load
        window.addEventListener('load', () => {
            const elements = document.querySelectorAll('.animate-slide-in');
            elements.forEach(el => {
                el.classList.add('animate-slide-in');
            });
        });

        // Tag form validation and enhancement
        document.addEventListener('DOMContentLoaded', function() {
            const tagForm = document.querySelector('form');
            const tagNameInput = document.getElementById('tag_name');

            if (tagForm && tagNameInput) {
                tagNameInput.addEventListener('input', function() {
                    // Auto-generate slug or validate tag name
                    this.value = this.value.toLowerCase().replace(/[^a-z0-9-]/g, '');
                });
            }

            // Search functionality
            const searchInput = document.querySelector('input[placeholder="Search users..."]');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const query = this.value.toLowerCase();
                    const rows = document.querySelectorAll('table tbody tr');

                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(query) ? '' : 'none';
                    });
                });
            }

            // Table sorting functionality
            const sortButtons = document.querySelectorAll('th .fa-sort');
            sortButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const th = this.closest('th');
                    const table = th.closest('table');
                    const tbody = table.querySelector('tbody');
                    const rows = Array.from(tbody.querySelectorAll('tr'));
                    const index = Array.from(th.parentNode.children).indexOf(th);

                    rows.sort((a, b) => {
                        const aText = a.children[index].textContent.trim();
                        const bText = b.children[index].textContent.trim();
                        return aText.localeCompare(bText);
                    });

                    rows.forEach(row => tbody.appendChild(row));
                });
            });
        });
    </script>
</body>

</html>
