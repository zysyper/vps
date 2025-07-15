@extends('layouts.app')

@section('content')
    <!-- Payment Page with Modern Responsive Design -->
    <div
        class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 py-4 sm:py-8 lg:py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-6 sm:mb-8 lg:mb-12">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl shadow-lg mb-4 sm:mb-6">
                    <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v2a2 2 0 002 2z" />
                    </svg>
                </div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-2 sm:mb-3">Pembayaran QRIS</h1>
                <p class="text-base sm:text-lg lg:text-xl text-gray-600 px-4">Scan QR code untuk melakukan pembayaran</p>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 lg:gap-8">
                <!-- Left Column - QR Code & Payment Info -->
                <div class="space-y-6 order-2 xl:order-1">
                    <!-- QR Code Card -->
                    <div class="bg-white rounded-2xl sm:rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
                            <h2 class="text-lg sm:text-xl lg:text-2xl font-bold text-white mb-1 sm:mb-2">QR Code Pembayaran
                            </h2>
                            <p class="text-sm sm:text-base text-blue-100">Scan menggunakan aplikasi mobile banking</p>
                        </div>

                        <div class="p-4 sm:p-6 lg:p-8">
                            <!-- QR Code Container -->
                            <div class="relative mb-6 sm:mb-8">
                                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-1 rounded-xl sm:rounded-2xl">
                                    <div class="bg-white p-4 sm:p-6 rounded-lg sm:rounded-xl">
                                        <div class="relative flex justify-center">
                                            <div class="relative">
                                                <img src="{{ asset('qris.png') }}" alt="QRIS"
                                                    class="w-48 h-48 sm:w-56 sm:h-56 lg:w-64 lg:h-64 object-cover rounded-lg sm:rounded-xl border-2 border-gray-200">

                                                <!-- Animated scanning line -->
                                                <div class="absolute inset-0 pointer-events-none">
                                                    <div
                                                        class="absolute top-0 left-0 w-full h-0.5 bg-gradient-to-r from-transparent via-blue-500 to-transparent animate-pulse">
                                                    </div>
                                                </div>

                                                <!-- Corner decorations -->
                                                <div
                                                    class="absolute -top-2 -left-2 w-4 h-4 sm:w-6 sm:h-6 border-t-2 sm:border-t-4 border-l-2 sm:border-l-4 border-blue-500 rounded-tl-lg sm:rounded-tl-xl">
                                                </div>
                                                <div
                                                    class="absolute -top-2 -right-2 w-4 h-4 sm:w-6 sm:h-6 border-t-2 sm:border-t-4 border-r-2 sm:border-r-4 border-blue-500 rounded-tr-lg sm:rounded-tr-xl">
                                                </div>
                                                <div
                                                    class="absolute -bottom-2 -left-2 w-4 h-4 sm:w-6 sm:h-6 border-b-2 sm:border-b-4 border-l-2 sm:border-l-4 border-blue-500 rounded-bl-lg sm:rounded-bl-xl">
                                                </div>
                                                <div
                                                    class="absolute -bottom-2 -right-2 w-4 h-4 sm:w-6 sm:h-6 border-b-2 sm:border-b-4 border-r-2 sm:border-r-4 border-blue-500 rounded-br-lg sm:rounded-br-xl">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Amount -->
                            <div
                                class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl sm:rounded-2xl p-4 sm:p-6 text-center">
                                <p class="text-xs sm:text-sm font-medium text-green-700 mb-2">Total Pembayaran</p>
                                <p class="text-2xl sm:text-3xl font-bold text-green-600 mb-2 break-words">
                                    Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                                </p>
                                <div class="flex items-center justify-center space-x-2 text-xs sm:text-sm text-green-600">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Sudah termasuk biaya admin</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Instructions -->
                    <div class="bg-white rounded-2xl sm:rounded-3xl shadow-xl border border-gray-100 p-4 sm:p-6 lg:p-8">
                        <div class="flex items-center mb-4 sm:mb-6">
                            <div
                                class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg sm:rounded-xl flex items-center justify-center mr-3 sm:mr-4 flex-shrink-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900">Panduan Pembayaran</h3>
                        </div>

                        <div class="space-y-4 sm:space-y-6">
                            <div class="flex items-start space-x-3 sm:space-x-4">
                                <div
                                    class="flex-shrink-0 w-6 h-6 sm:w-8 sm:h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold text-xs sm:text-sm">
                                    1</div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-gray-800 text-sm sm:text-base">Buka Aplikasi</h4>
                                    <p class="text-gray-600 text-sm sm:text-base">Buka aplikasi mobile banking atau e-wallet
                                        favorit Anda</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3 sm:space-x-4">
                                <div
                                    class="flex-shrink-0 w-6 h-6 sm:w-8 sm:h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold text-xs sm:text-sm">
                                    2</div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-gray-800 text-sm sm:text-base">Scan QR Code</h4>
                                    <p class="text-gray-600 text-sm sm:text-base">Pilih menu "Scan QR" atau "QRIS" dan scan
                                        kode di atas</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3 sm:space-x-4">
                                <div
                                    class="flex-shrink-0 w-6 h-6 sm:w-8 sm:h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold text-xs sm:text-sm">
                                    3</div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-gray-800 text-sm sm:text-base">Konfirmasi Pembayaran</h4>
                                    <p class="text-gray-600 text-sm sm:text-base">Periksa nominal dan konfirmasi pembayaran
                                        di aplikasi</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3 sm:space-x-4">
                                <div
                                    class="flex-shrink-0 w-6 h-6 sm:w-8 sm:h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold text-xs sm:text-sm">
                                    4</div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-gray-800 text-sm sm:text-base">Upload Bukti</h4>
                                    <p class="text-gray-600 text-sm sm:text-base">Screenshot bukti pembayaran dan upload di
                                        form sebelah</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Upload Form -->
                <div class="space-y-6 order-1 xl:order-2">
                    <!-- Upload Form Card -->
                    <div class="bg-white rounded-2xl sm:rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
                            <h2 class="text-lg sm:text-xl lg:text-2xl font-bold text-white mb-1 sm:mb-2">Upload Bukti
                                Pembayaran</h2>
                            <p class="text-sm sm:text-base text-indigo-100">Upload screenshot atau foto bukti pembayaran</p>
                        </div>

                        <form action="{{ route('orders.payment.proof', $order->id) }}" method="POST"
                            enctype="multipart/form-data" class="p-4 sm:p-6 lg:p-8" id="paymentForm">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $order->id }}">

                            <!-- Upload Area -->
                            <div class="mb-6 sm:mb-8">
                                <div id="upload-area"
                                    class="border-2 border-dashed border-gray-300 rounded-xl sm:rounded-2xl p-4 sm:p-6 lg:p-8 text-center hover:border-indigo-400 transition-colors duration-300 cursor-pointer">
                                    <!-- Default Upload State -->
                                    <div id="upload-default" class="upload-state">
                                        <div
                                            class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl sm:rounded-2xl flex items-center justify-center mx-auto mb-3 sm:mb-4">
                                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                        </div>
                                        <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-2">Drag & Drop File
                                        </h3>
                                        <p class="text-gray-600 mb-4 sm:mb-6 text-sm sm:text-base">atau klik untuk memilih
                                            file</p>

                                        <div class="mt-3 sm:mt-4 text-xs sm:text-sm text-gray-500 space-y-1">
                                            <p>Mendukung: JPG, PNG, GIF, WEBP, PDF</p>
                                            <p>Maksimal ukuran: 5MB</p>
                                        </div>
                                    </div>

                                    <!-- File Preview State -->
                                    <div id="file-preview" class="upload-state hidden">
                                        <div class="flex flex-col items-center">
                                            <!-- Image Preview -->
                                            <div id="image-preview" class="hidden mb-4">
                                                <img id="preview-image" class="max-w-full max-h-64 rounded-lg shadow-lg"
                                                    alt="Preview">
                                            </div>

                                            <!-- PDF Preview -->
                                            <div id="pdf-preview" class="hidden mb-4">
                                                <div
                                                    class="w-20 h-20 sm:w-24 sm:h-24 bg-red-100 rounded-lg flex items-center justify-center">
                                                    <svg class="w-10 h-10 sm:w-12 sm:h-12 text-red-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                </div>
                                            </div>

                                            <!-- File Info -->
                                            <div class="text-center mb-4">
                                                <h4 id="file-name"
                                                    class="text-sm sm:text-base font-semibold text-gray-800 mb-1"></h4>
                                                <p id="file-size" class="text-xs sm:text-sm text-gray-500"></p>
                                            </div>

                                            <!-- Action Buttons -->
                                            <div class="flex flex-col sm:flex-row gap-2 sm:gap-4">
                                                <button type="button" id="change-file-btn"
                                                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-medium rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 text-sm">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                    </svg>
                                                    Ganti File
                                                </button>
                                                <button type="button" id="remove-file"
                                                    class="inline-flex items-center px-4 py-2 bg-red-500 text-white font-medium rounded-lg hover:bg-red-600 transition-colors duration-200 text-sm">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <input id="file-upload" name="file" type="file" class="sr-only"
                                        accept="image/*,.pdf" required>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="space-y-3 sm:space-y-4">
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 sm:py-4 px-4 sm:px-6 rounded-lg sm:rounded-xl font-semibold text-base sm:text-lg shadow-lg hover:from-indigo-700 hover:to-purple-700 transform hover:-translate-y-0.5 transition-all duration-200">
                                    Kirim Bukti Pembayaran
                                </button>

                                <a href="{{ route('my-orders') }}"
                                    class="block w-full bg-gray-100 hover:bg-gray-200 text-gray-800 py-3 sm:py-4 px-4 sm:px-6 rounded-lg sm:rounded-xl font-medium text-center transition-colors duration-200 text-sm sm:text-base">
                                    Kembali ke Pesanan
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('file-upload');
            const uploadArea = document.getElementById('upload-area');
            const uploadDefault = document.getElementById('upload-default');
            const filePreview = document.getElementById('file-preview');
            const imagePreview = document.getElementById('image-preview');
            const pdfPreview = document.getElementById('pdf-preview');
            const previewImage = document.getElementById('preview-image');
            const fileName = document.getElementById('file-name');
            const fileSize = document.getElementById('file-size');
            const removeFileBtn = document.getElementById('remove-file');
            const changeFileBtn = document.getElementById('change-file-btn');
            const paymentForm = document.getElementById('paymentForm');

            // File size formatter
            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            // Show file preview
            function showFilePreview(file) {
                fileName.textContent = file.name;
                fileSize.textContent = formatFileSize(file.size);

                // Hide default upload state
                uploadDefault.classList.add('hidden');
                filePreview.classList.remove('hidden');

                // Change upload area appearance
                uploadArea.classList.remove('border-gray-300', 'hover:border-indigo-400', 'cursor-pointer');
                uploadArea.classList.add('border-indigo-400', 'bg-indigo-50');

                // Show appropriate preview based on file type
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        imagePreview.classList.remove('hidden');
                        pdfPreview.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                } else if (file.type === 'application/pdf') {
                    imagePreview.classList.add('hidden');
                    pdfPreview.classList.remove('hidden');
                } else {
                    // For other file types, show generic preview
                    imagePreview.classList.add('hidden');
                    pdfPreview.classList.add('hidden');
                }
            }

            // Reset to default state
            function resetUploadArea() {
                uploadDefault.classList.remove('hidden');
                filePreview.classList.add('hidden');
                imagePreview.classList.add('hidden');
                pdfPreview.classList.add('hidden');

                // Reset upload area appearance
                uploadArea.classList.remove('border-indigo-400', 'bg-indigo-50');
                uploadArea.classList.add('border-gray-300', 'hover:border-indigo-400', 'cursor-pointer');

                // Clear file input
                fileInput.value = '';
                previewImage.src = '';
            }

            // Validate file
            function validateFile(file) {
                const maxSize = 5 * 1024 * 1024; // 5MB
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'application/pdf'];

                if (file.size > maxSize) {
                    alert('Ukuran file terlalu besar! Maksimal 5MB.');
                    return false;
                }

                if (!allowedTypes.includes(file.type)) {
                    alert('Format file tidak didukung! Gunakan JPG, PNG, GIF, WEBP, atau PDF.');
                    return false;
                }

                return true;
            }

            // Handle file input change
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file && validateFile(file)) {
                    showFilePreview(file);
                } else {
                    resetUploadArea();
                }
            });

            // Handle drag and drop
            uploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                if (uploadDefault.classList.contains('hidden')) return; // Don't allow drag over preview
                uploadArea.classList.add('border-indigo-500', 'bg-indigo-50');
            });

            uploadArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                if (!fileInput.files.length) {
                    uploadArea.classList.remove('border-indigo-500', 'bg-indigo-50');
                }
            });

            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                if (uploadDefault.classList.contains('hidden')) return; // Don't allow drop on preview

                uploadArea.classList.remove('border-indigo-500', 'bg-indigo-50');

                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    const file = files[0];
                    if (validateFile(file)) {
                        // Set file to input
                        const dt = new DataTransfer();
                        dt.items.add(file);
                        fileInput.files = dt.files;

                        showFilePreview(file);
                    }
                }
            });

            // Handle upload area click - only when showing default state
            uploadArea.addEventListener('click', function(e) {
                // Only trigger file input if we're in default state
                if (!uploadDefault.classList.contains('hidden')) {
                    fileInput.click();
                }
            });

            // Handle change file button
            changeFileBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                fileInput.click();
            });

            // Handle remove file button
            removeFileBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                resetUploadArea();
            });

            // Handle form submission
            paymentForm.addEventListener('submit', function(e) {
                if (!fileInput.files.length) {
                    e.preventDefault();
                    alert('Silakan pilih file bukti pembayaran terlebih dahulu!');
                    return false;
                }

                // Show loading state
                const submitBtn = paymentForm.querySelector('button[type="submit"]');
                const originalText = submitBtn.textContent;
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Mengupload...
                `;

                // Reset after 30 seconds if something goes wrong
                setTimeout(function() {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                }, 30000);
            });
        });
    </script>
@endsection
