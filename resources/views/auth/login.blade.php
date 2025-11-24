<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Login Politeknik') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=roboto:400,500,700&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom Colors berdasarkan gambar dashboard Anda */
        .bg-poli-dark { background-color: #0a2e5c; } /* Biru Dongker Header */
        .bg-poli-light { background-color: #00a8e8; } /* Biru Terang Tombol */
        .hover-poli-light:hover { background-color: #0095ce; }
        .text-poli-dark { color: #0a2e5c; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900">

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
        
        <div class="mb-6 text-center">
            <a href="/" class="flex flex-col items-center">
                <svg class="w-14 h-14 text-blue-600 mb-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 3L1 9l11 6 9-4.91V17h2V9M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82Z" />
                </svg>
                <h1 class="text-2xl font-bold text-poli-dark uppercase tracking-wide">POLITEKNIK BAAK</h1>
                <p class="text-xs text-gray-500 tracking-widest uppercase mt-1">Empowers You to Global Competition</p>
            </a>
        </div>

        <div class="w-full sm:max-w-md bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
            
            <div class="bg-poli-dark py-4 px-6 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
                <h2 class="text-white font-bold text-lg uppercase tracking-wide">Welcome Back</h2>
            </div>

            <div class="px-6 py-8">
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-5">
                        <label for="email" class="block font-medium text-sm text-gray-700 uppercase text-xs mb-1">Email / Username</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2.5 px-3 bg-gray-50" 
                            placeholder="Masukkan Email Anda...">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block font-medium text-sm text-gray-700 uppercase text-xs mb-1">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2.5 px-3 bg-gray-50"
                            placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between mb-6">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                            <span class="ml-2 text-sm text-gray-600">Ingat Saya</span>
                        </label>
                        
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-500 hover:text-blue-800" href="{{ route('password.request') }}">
                                Lupa Password?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="w-full bg-poli-light hover-poli-light text-white font-bold py-3 px-4 rounded shadow-md flex justify-center items-center transition duration-150 uppercase tracking-wider text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Masuk Aplikasi
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-8 text-center text-sm text-gray-400">
            &copy; {{ date('Y') }} Politeknik BAAK. All rights reserved.
        </div>
    </div>
</body>
</html>