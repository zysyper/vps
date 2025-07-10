@extends('layouts.app')
@section('content')
<div class="min-h-screen px-4 py-8 bg-gradient-to-br from-blue-50 via-white to-indigo-50">
    <div class="max-w-md mx-auto">
        <!-- Main Payment Card -->
        <div class="p-8 space-y-8 bg-white border border-gray-100 shadow-xl rounded-3xl backdrop-blur-sm">
            <!-- Header Section -->
            <div class="space-y-3 text-center">
                <div class="flex items-center justify-center w-16 h-16 mx-auto shadow-lg bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h4"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-800">Pembayaran QRIS</h2>
                <p class="text-gray-600">Scan QR code di bawah ini untuk melanjutkan pembayaran</p>
            </div>

            <!-- QR Code Section -->
            <div class="relative">
                <div class="p-1 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl">
                    <div class="flex justify-center p-6 bg-white rounded-xl">
                        <div class="relative">
                            <!-- QR Code placeholder with animation -->
                            <div class="relative flex items-center justify-center w-64 h-64 overflow-hidden bg-gray-100 border-2 border-gray-300 border-dashed rounded-xl">
                                <!-- Replace this div with actual QR code -->
                                <img src="{{ asset('qris.png') }}" alt="QRIS" class="object-cover w-full h-full rounded-lg">

                                <!-- Scanning animation overlay -->
                                <div class="absolute inset-0 pointer-events-none">
                                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-blue-500 to-transparent animate-pulse"></div>
                                </div>
                            </div>

                            <!-- Corner decorations -->
                            <div class="absolute w-6 h-6 border-t-4 border-l-4 border-blue-500 rounded-tl-lg -top-2 -left-2"></div>
                            <div class="absolute w-6 h-6 border-t-4 border-r-4 border-blue-500 rounded-tr-lg -top-2 -right-2"></div>
                            <div class="absolute w-6 h-6 border-b-4 border-l-4 border-blue-500 rounded-bl-lg -bottom-2 -left-2"></div>
                            <div class="absolute w-6 h-6 border-b-4 border-r-4 border-blue-500 rounded-br-lg -bottom-2 -right-2"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Amount Section -->
            <div class="p-6 space-y-2 text-center bg-gray-50 rounded-2xl">
                <p class="text-sm font-medium text-gray-500">Nominal Pembayaran</p>
                <p class="text-3xl font-bold text-green-600">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                <div class="flex items-center justify-center space-x-2 text-sm text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Kirim Bukti Pembayaran ke Nomor Whatsapp ini</span>
                </div>
                <a class="mt-6 font-bold text-center text-blue-600 text-1xl" href="https://wa.me/+6285810200320" target="_blank">085810200320</a>
            </div>




            <!-- Instructions -->
            <div class="p-4 space-y-3 bg-blue-50 rounded-2xl">
                <h4 class="flex items-center font-semibold text-blue-900">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Cara Pembayaran
                </h4>
                <ol class="space-y-2 text-sm text-blue-800">
                    <li class="flex items-start">
                        <span class="bg-blue-200 text-blue-800 rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mr-3 mt-0.5">1</span>
                        Buka aplikasi mobile banking atau e-wallet
                    </li>
                    <li class="flex items-start">
                        <span class="bg-blue-200 text-blue-800 rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mr-3 mt-0.5">2</span>
                        Pilih menu "Scan QR" atau "QRIS"
                    </li>
                    <li class="flex items-start">
                        <span class="bg-blue-200 text-blue-800 rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mr-3 mt-0.5">3</span>
                        Scan QR code yang tersedia
                    </li>
                    <li class="flex items-start">
                        <span class="bg-blue-200 text-blue-800 rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mr-3 mt-0.5">4</span>
                        Konfirmasi pembayaran di aplikasi
                    </li>
                </ol>
            </div>

            <!-- Action Button -->
            <div class="space-y-4">
                <a href="https://wa.me/+6285810200320" class="block w-full px-6 py-3 font-medium text-center text-white transition-colors duration-200 bg-blue-500 rounded-2xl hover:bg-blue-200">
                    Kirim Bukti Pembayaran
                </a>

                <button type="button"
                    data-hs-overlay="#payment-status"
                    class="flex items-center justify-center w-full px-6 py-4 space-x-2 font-semibold text-white transition-all duration-200 transform shadow-lg bg-gradient-to-r from-green-500 to-green-600 rounded-2xl hover:from-green-600 hover:to-green-700 hover:scale-105 hover:shadow-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="5 13l4 4L19 7"></path>
                    </svg>
                    <span>Saya Sudah Bayar</span>
                </button>

                <a href="{{ route('my-orders') }}" class="block w-full px-6 py-3 font-medium text-center text-gray-700 transition-colors duration-200 bg-gray-100 rounded-2xl hover:bg-gray-200">
                    Kembali
                </a>

            </div>

            <!-- Timer Section -->
            <div class="p-4 text-center bg-yellow-50 rounded-2xl">
                <p class="text-sm font-medium text-yellow-800">Selesaikan pembayaran dalam</p>
                <div class="mt-1 text-2xl font-bold text-yellow-600" id="countdown">24 Jam</div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Modal -->
<div id="payment-status" class="hs-overlay hidden fixed inset-0 z-[80] overflow-y-auto bg-black/50 backdrop-blur-sm">
    <div class="w-full max-w-md px-4 mx-auto mt-20 transition-all ease-in-out hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 hs-overlay-open:scale-100 hs-overlay-close:mt-0 hs-overlay-close:opacity-0 hs-overlay-close:scale-95">
        <div class="p-8 space-y-6 text-center bg-white border border-gray-100 shadow-2xl rounded-3xl">
            <!-- Loading Animation -->
            <div class="w-20 h-20 mx-auto">
                <div class="relative">
                    <div class="w-20 h-20 border-4 border-blue-200 rounded-full"></div>
                    <div class="absolute top-0 left-0 w-20 h-20 border-4 border-blue-600 rounded-full border-t-transparent animate-spin"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <h3 class="text-2xl font-bold text-gray-800">Memverifikasi Pembayaran</h3>
                <p class="text-gray-600">Mohon tunggu sebentar, kami sedang memverifikasi pembayaran Anda...</p>
            </div>

            <div class="flex space-x-3">
                <button type="button"
                    class="flex-1 px-6 py-3 font-medium text-gray-700 transition-colors duration-200 bg-gray-100 rounded-2xl hover:bg-gray-200"
                    data-hs-overlay="#payment-status">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>



@endsection
