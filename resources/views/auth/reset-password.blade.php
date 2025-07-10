@extends('layouts.app')

@section('content')
<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="flex items-center h-full">
      <main class="w-full max-w-md p-6 mx-auto">
        <div class="bg-white border border-gray-200 shadow-sm mt-7 rounded-xl dark:bg-gray-800 dark:border-gray-700">
          <div class="p-4 sm:p-7">
            <div class="text-center">
              <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Reset password</h1>
              <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Remember your password?
                <a class="text-blue-600 decoration-2 hover:underline font-medium" href="{{ route('login') }}">
                  Sign in here
                </a>
              </p>
            </div>

            <div class="mt-5">
              <!-- Form -->
              <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="grid gap-y-4">
                  <!-- Email Form Group -->
                  <div>
                    <label for="email" class="block mb-2 text-sm dark:text-white">Email</label>
                    <div class="relative">
                      <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ $email ?? old('email') }}"
                        class="block w-full px-4 py-3 text-sm border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-200' }} rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                        required
                        aria-describedby="email-error"
                        readonly
                      >
                      @error('email')
                      <div class="absolute inset-y-0 flex items-center pointer-events-none end-0 pe-3">
                        <svg class="w-5 h-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                        </svg>
                      </div>
                      @enderror
                    </div>
                    @error('email')
                    <p class="mt-2 text-xs text-red-600" id="email-error">{{ $message }}</p>
                    @enderror
                  </div>
                  <!-- End Email Form Group -->

                  <!-- Password Form Group -->
                  <div>
                    <label for="password" class="block mb-2 text-sm dark:text-white">Password</label>
                    <div class="relative">
                      <input
                        type="password"
                        id="password"
                        name="password"
                        class="block w-full px-4 py-3 text-sm border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-200' }} rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                        required
                        aria-describedby="password-error"
                      >
                      @error('password')
                      <div class="absolute inset-y-0 flex items-center pointer-events-none end-0 pe-3">
                        <svg class="w-5 h-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                        </svg>
                      </div>
                      @enderror
                    </div>
                    @error('password')
                    <p class="mt-2 text-xs text-red-600" id="password-error">{{ $message }}</p>
                    @enderror
                  </div>
                  <!-- End Password Form Group -->

                  <!-- Password Confirmation Form Group -->
                  <div>
                    <label for="password_confirmation" class="block mb-2 text-sm dark:text-white">Confirm Password</label>
                    <div class="relative">
                      <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="block w-full px-4 py-3 text-sm border {{ $errors->has('password_confirmation') ? 'border-red-500' : 'border-gray-200' }} rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                        required
                        aria-describedby="password_confirmation-error"
                      >
                      @error('password_confirmation')
                      <div class="absolute inset-y-0 flex items-center pointer-events-none end-0 pe-3">
                        <svg class="w-5 h-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                        </svg>
                      </div>
                      @enderror
                    </div>
                    @error('password_confirmation')
                    <p class="mt-2 text-xs text-red-600" id="password_confirmation-error">{{ $message }}</p>
                    @enderror
                  </div>
                  <!-- End Password Confirmation Form Group -->

                  <!-- Flash Messages -->
                  @if (session('error'))
                  <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    {{ session('error') }}
                  </div>
                  @endif

                  @if (session('status'))
                  <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    {{ session('status') }}
                  </div>
                  @endif

                  <button type="submit" class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
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
