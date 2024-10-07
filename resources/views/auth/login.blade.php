@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="max-w-md w-full bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>

            @if (session('error'))
                <div class="bg-red-500 text-white text-sm p-2 mb-4 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @enderror" placeholder="Email" required>
                    @error('email')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" name="password" id="password" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('password') border-red-500 @enderror" placeholder="Password" required>
                    @error('password')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mb-6">
                    <button type="submit" class="w-full bg-[#E01535] text-white py-3 rounded-lg hover:bg-[#E01535] focus:outline-none focus:ring-2 focus:ring-red-300">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
