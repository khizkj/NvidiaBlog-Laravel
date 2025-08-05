@extends('components.layout')

@section('title', 'Signup - Nvidia Blog')

@section('content')
    <!-- Signup Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-800 to-green-900 opacity-50"></div>

        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 left-10 w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            <div class="absolute top-40 right-20 w-1 h-1 bg-green-400 rounded-full animate-ping"></div>
            <div class="absolute bottom-20 left-1/4 w-3 h-3 bg-green-300 rounded-full animate-bounce"></div>
            <div class="absolute bottom-40 right-1/3 w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            <div class="absolute top-1/2 left-20 w-1 h-1 bg-green-300 rounded-full animate-ping"></div>
            <div class="absolute top-1/3 right-10 w-2 h-2 bg-green-400 rounded-full animate-bounce"></div>
        </div>

        <div class="relative z-10 max-w-md w-full space-y-8">
            <!-- Logo and Header -->
            <div class="text-center">
                <div class="flex items-center justify-center space-x-3 mb-6">
                    <div class="w-12 h-12 nvidia-green-bg rounded-xl flex items-center justify-center">
                        <i class="fas fa-bolt text-black text-xl font-bold"></i>
                    </div>
                    <div>
                        <span class="text-2xl font-bold nvidia-green">NVIDIA</span>
                        <span class="text-lg text-gray-400 ml-2">Blog</span>
                    </div>
                </div>
                <h2 class="text-3xl font-bold text-white mb-2">Create Account</h2>
                <p class="text-gray-400">Join us and explore the tech world</p>
            </div>

            <!-- Signup Form -->
            <div class="bg-gray-800 bg-opacity-80 backdrop-blur-lg rounded-2xl p-8 shadow-xl border border-gray-700">
                <form class="space-y-6" method="POST" action="/signup">
                    @csrf
                    <!-- Name -->
                    <div>
                        <label for="full_name" class="block text-sm font-semibold text-gray-300 mb-3">
                            Full Name
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input type="text" id="full_name" name="full_name" placeholder="Enter your name"
                                class="w-full pl-12 pr-4 py-4 bg-gray-700 bg-opacity-50 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-white placeholder-gray-400 transition-all duration-300"
                                required>
                        </div>
                        @error('full_name')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-300 mb-3">
                            Email Address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" id="email" name="email" placeholder="Enter your email"
                                class="w-full pl-12 pr-4 py-4 bg-gray-700 bg-opacity-50 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-white placeholder-gray-400 transition-all duration-300"
                                required>
                        </div>
                        @error('email')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-300 mb-3">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" id="password" name="password" placeholder="Create a password"
                                class="w-full pl-12 pr-12 py-4 bg-gray-700 bg-opacity-50 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-white placeholder-gray-400 transition-all duration-300"
                                required>
                            <button type="button"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-white transition-colors"
                                onclick="togglePassword('password', 'password-toggle')">
                                <i class="fas fa-eye" id="password-toggle"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="confirm_password" class="block text-sm font-semibold text-gray-300 mb-3">
                            Confirm Password *
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Repeat your password"
                                class="w-full pl-12 pr-12 py-4 bg-gray-700 bg-opacity-50 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-white placeholder-gray-400 transition-all duration-300"
                                required>
                            <button type="button"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-white transition-colors"
                                onclick="togglePassword('password_confirmation', 'password_confirmation-toggle')">
                                <i class="fas fa-eye" id="confirm-password-toggle"></i>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Signup Button -->
                        <button type="submit"
                            class="w-full py-4 nvidia-green-bg text-black font-bold rounded-lg hover-scale glow-effect transition-all duration-300">
                            <i class="fas fa-user-plus mr-2"></i>
                            Create Account
                        </button>

                    </form>
                </div>

                <!-- Already have an account -->
                <div class="text-center">
                    <p class="text-gray-400">
                        Already have an account?
                        <a href="/login" class="nvidia-green hover:text-green-400 font-semibold transition-colors">
                            Login here
                        </a>
                    </p>
                </div>
            </div>
        </section>

        <script>
            function togglePassword(inputId, toggleIconId) {
                const passwordInput = document.getElementById(inputId);
                const toggleIcon = document.getElementById(toggleIconId);

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                }
            }
        </script>
    @endsection
