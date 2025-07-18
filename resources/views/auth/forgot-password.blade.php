@extends('layouts.guest')

@section('content')
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="flex items-center h-full">
            <main class="w-full max-w-md p-6 mx-auto">
                <div class="bg-white border border-gray-200 shadow-sm mt-7 rounded-xl dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-4 sm:p-7">
                        <div class="text-center">
                            <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Forgot password?</h1>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                Remember your password?
                                <a class="font-medium text-blue-600 decoration-2 hover:underline dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                    href="{{ route('login') }}">
                                    Sign in here
                                </a>
                            </p>
                        </div>

                        <div class="mt-5">
                            <!-- Form -->
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                @if (session('success'))
                                    <div class="p-4 mb-4 text-sm text-white bg-green-500 rounded-lg" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if (session('status'))
                                    <div class="p-4 mb-4 text-sm text-white bg-green-500 rounded-lg" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <div class="grid gap-y-4">
                                    <!-- Form Group -->
                                    <div>
                                        <label for="email" class="block mb-2 text-sm dark:text-white">Email
                                            address</label>
                                        <div class="relative">
                                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                                class="block w-full px-4 py-3 text-sm border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-200' }} rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                                                required aria-describedby="email-error">
                                            @error('email')
                                                <div
                                                    class="absolute inset-y-0 flex items-center pointer-events-none end-0 pe-3">
                                                    <svg class="w-5 h-5 text-red-500" width="16" height="16"
                                                        fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                                        <path
                                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                                    </svg>
                                                </div>
                                            @enderror
                                        </div>
                                        @error('email')
                                            <p class="mt-2 text-xs text-red-600" id="email-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <!-- End Form Group -->
                                    <button type="submit"
                                        class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                        Reset password
                                    </button>
                                </div>
                            </form>
                            <!-- End Form -->
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
