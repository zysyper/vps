@extends('layouts.guest')

@section('content')
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="flex items-center h-full">
            <main class="w-full max-w-md p-6 mx-auto">
                <div class="bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-4 sm:p-7">
                        <div class="text-center">
                            <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Sign in</h1>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                Don't have an account yet?
                                <a class="font-medium text-blue-600 decoration-2 hover:underline dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                    href="{{ route('register') }}">
                                    Sign up here
                                </a>
                            </p>
                        </div>

                        <hr class="my-5 border-slate-300">

                        <!-- Form -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="grid gap-y-4">
                                <!-- Form Group -->
                                <div>
                                    <label for="email" class="block mb-2 text-sm dark:text-white">Email address</label>
                                    <div class="relative">
                                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                                            class="block w-full px-4 py-3 text-sm border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-200' }} rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                                            required autocomplete="email" autofocus>
                                        @error('email')
                                            <div class="absolute inset-y-0 flex items-center pointer-events-none end-0 pe-3">
                                                <svg class="w-5 h-5 text-red-500" width="16" height="16"
                                                    fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                                    <path
                                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                                </svg>
                                            </div>
                                        @enderror
                                    </div>
                                    @error('email')
                                        <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- End Form Group -->

                                <!-- Form Group -->
                                <div>
                                    <div class="flex items-center justify-between">
                                        <label for="password" class="block mb-2 text-sm dark:text-white">Password</label>
                                        <a class="text-sm font-medium text-blue-600 decoration-2 hover:underline dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                            href="{{ route('password.request') }}">Forgot password?</a>
                                    </div>
                                    <div class="relative">
                                        <input type="password" id="password" name="password"
                                            class="block w-full px-4 py-3 text-sm border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-200' }} rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                                            required autocomplete="current-password">
                                        @error('password')
                                            <div class="absolute inset-y-0 flex items-center pointer-events-none end-0 pe-3">
                                                <svg class="w-5 h-5 text-red-500" width="16" height="16"
                                                    fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                                    <path
                                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                                </svg>
                                            </div>
                                        @enderror
                                    </div>
                                    @error('password')
                                        <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- End Form Group -->

                                <!-- Remember Me -->
                                <div class="flex items-center">
                                    <input name="remember_me" id="remember-me" type="checkbox"
                                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                        {{ old('remember_me') ? 'checked' : '' }}>
                                    <label for="remember-me" class="block ml-2 text-sm text-gray-600 dark:text-gray-400">
                                        Remember me
                                    </label>
                                </div>

                                <button type="submit"
                                    class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                    Sign in
                                </button>
                            </div>
                        </form>
                        <!-- End Form -->
                    </div>
                </div>
        </div>
    </div>
    </div>
@endsection
