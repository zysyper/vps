@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="max-w-6xl px-4 py-8 mx-auto">
        @if ($errors->any())
            <div class="p-4 mb-6 border border-red-200 rounded-md bg-red-50">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pada form:</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul role="list" class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <!-- Checkout Form -->
            <div class="col-span-2 p-6 bg-white rounded-lg shadow-lg">
                <form x-data="{ loading: false }" @submit="loading = true" action="{{ route('checkout.place') }}" method="POST"
                    enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="mb-6">
                        <h2 class="pb-2 mb-4 text-xl font-semibold text-gray-700 border-b">Informasi Pembeli</h2>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div>
                                <label for="first_name" class="block mb-1 text-sm font-medium text-gray-700">Nama
                                    Depan</label>
                                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('first_name') border-red-300 @enderror"
                                    placeholder="Masukkan nama depan" required>
                                @error('first_name')
                                    <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="last_name" class="block mb-1 text-sm font-medium text-gray-700">Nama
                                    Belakang</label>
                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('last_name') border-red-300 @enderror"
                                    placeholder="Masukkan nama belakang" required>
                                @error('last_name')
                                    <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="phone" class="block mb-1 text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('phone') border-red-300 @enderror"
                            placeholder="Masukkan nomor telepon" required>
                        @error('phone')
                            <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Enhanced File Upload Section -->
                    <div class="mb-8" x-data="{
                        isDropping: false,
                        fileName: '',
                        fileSize: '',
                        fileType: '',
                        isUploaded: false,
                        previewUrl: null,
                        handleFileDrop(e) {
                            e.preventDefault();
                            this.isDropping = false;

                            let files = e.dataTransfer.files;
                            if (files.length > 0) {
                                this.processFile(files[0]);
                                document.getElementById('file-upload').files = files;
                            }
                        },
                        handleFileSelect(e) {
                            if (e.target.files.length > 0) {
                                this.processFile(e.target.files[0]);
                            }
                        },
                        processFile(file) {
                            this.fileName = file.name;
                            this.fileSize = this.formatFileSize(file.size);
                            this.fileType = file.type;
                            this.isUploaded = true;

                            // Create preview for images
                            if (file.type.startsWith('image/')) {
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    this.previewUrl = e.target.result;
                                };
                                reader.readAsDataURL(file);
                            } else {
                                this.previewUrl = null;
                            }
                        },
                        formatFileSize(bytes) {
                            if (bytes === 0) return '0 Bytes';
                            const k = 1024;
                            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                            const i = Math.floor(Math.log(bytes) / Math.log(k));
                            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
                        },
                        removeFile() {
                            this.fileName = '';
                            this.fileSize = '';
                            this.fileType = '';
                            this.isUploaded = false;
                            this.previewUrl = null;
                            document.getElementById('file-upload').value = '';
                        },
                        getFileIcon(type) {
                            if (type.startsWith('image/')) return 'image';
                            if (type === 'application/pdf') return 'pdf';
                            return 'file';
                        }
                    }">

                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                            <div class="p-6 border-b border-gray-200">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center w-10 h-10 bg-blue-100 rounded-lg">
                                        <svg class="w-5 h-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">Upload File Desain</h3>
                                        <p class="text-sm text-gray-500">Upload file desain Anda untuk proses cetak</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6">
                                <!-- Upload Area -->
                                <div x-show="!isUploaded">
                                    <div class="relative border-2 border-dashed rounded-xl transition-all duration-300 ease-in-out hover:border-blue-400 group"
                                        :class="{
                                            'border-blue-500 bg-blue-50 ring-2 ring-blue-200': isDropping,
                                            'border-gray-300 hover:bg-gray-50': !isDropping
                                        }"
                                        @dragover.prevent="isDropping = true" @dragleave.prevent="isDropping = false"
                                        @drop.prevent="handleFileDrop($event)">
                                        <div class="p-8 text-center">
                                            <!-- Upload Icon with Animation -->
                                            <div
                                                class="mx-auto mb-4 w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center transform transition-transform duration-300 group-hover:scale-110">
                                                <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                                                </svg>
                                            </div>

                                            <!-- Upload Text -->
                                            <div class="mb-4">
                                                <h4 class="text-xl font-semibold text-gray-800 mb-2">
                                                    <span x-show="!isDropping">Pilih file atau drag & drop di sini</span>
                                                    <span x-show="isDropping" class="text-blue-600">Lepaskan file untuk
                                                        upload</span>
                                                </h4>
                                                <p class="text-gray-500">Mendukung JPG, PNG, GIF, WEBP, dan PDF</p>
                                            </div>

                                            <!-- Upload Button -->
                                            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                                                <label for="file-upload"
                                                    class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg cursor-pointer transition-colors duration-200 shadow-sm hover:shadow-md">
                                                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 4.5v15m7.5-7.5h-15" />
                                                    </svg>
                                                    Pilih File
                                                </label>

                                                <div class="flex items-center text-sm text-gray-500">
                                                    <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                                    </svg>
                                                    Maksimal 5MB
                                                </div>
                                            </div>

                                            <input id="file-upload" name="file" type="file" class="sr-only"
                                                accept="image/*,.pdf" @change="handleFileSelect($event)">
                                        </div>
                                    </div>
                                </div>

                                <!-- File Preview -->
                                <div x-show="isUploaded" x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform scale-95"
                                    x-transition:enter-end="opacity-100 transform scale-100">
                                    <div
                                        class="bg-gradient-to-r from-green-50 to-blue-50 border border-green-200 rounded-xl p-6">
                                        <div class="flex items-start justify-between mb-4">
                                            <div class="flex items-center gap-4">
                                                <!-- Success Icon -->
                                                <div
                                                    class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-xl">
                                                    <svg class="w-6 h-6 text-green-600" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h4 class="font-semibold text-gray-800">File berhasil dipilih!</h4>
                                                    <p class="text-sm text-gray-600">Siap untuk diupload</p>
                                                </div>
                                            </div>

                                            <!-- Remove Button -->
                                            <button type="button" @click="removeFile()"
                                                class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors duration-200"
                                                title="Hapus file">
                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- File Info -->
                                        <div class="flex items-center gap-4">
                                            <!-- File Preview/Icon -->
                                            <div class="flex-shrink-0">
                                                <template x-if="previewUrl">
                                                    <div
                                                        class="w-16 h-16 bg-white rounded-lg overflow-hidden shadow-sm border">
                                                        <img :src="previewUrl" :alt="fileName"
                                                            class="w-full h-full object-cover">
                                                    </div>
                                                </template>
                                                <template x-if="!previewUrl">
                                                    <div
                                                        class="w-16 h-16 bg-white rounded-lg flex items-center justify-center shadow-sm border">
                                                        <template x-if="getFileIcon(fileType) === 'pdf'">
                                                            <svg class="w-8 h-8 text-red-500"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                            </svg>
                                                        </template>
                                                        <template x-if="getFileIcon(fileType) === 'file'">
                                                            <svg class="w-8 h-8 text-gray-500"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621 0 1.125.504 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                            </svg>
                                                        </template>
                                                    </div>
                                                </template>
                                            </div>

                                            <!-- File Details -->
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-800 truncate" x-text="fileName">
                                                </p>
                                                <div class="flex items-center gap-4 mt-1">
                                                    <span class="text-xs text-gray-500" x-text="fileSize"></span>
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-blue-100 text-blue-800">
                                                        <template x-if="fileType.startsWith('image/')">
                                                            <span>Gambar</span>
                                                        </template>
                                                        <template x-if="fileType === 'application/pdf'">
                                                            <span>PDF</span>
                                                        </template>
                                                        <template
                                                            x-if="!fileType.startsWith('image/') && fileType !== 'application/pdf'">
                                                            <span>File</span>
                                                        </template>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Upload Another File Button -->
                                        <div class="mt-4 pt-4 border-t border-gray-200">
                                            <button type="button" @click="removeFile()"
                                                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                                </svg>
                                                Ganti File
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Error Display -->
                                @error('file')
                                    <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-xl">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-red-400 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                            </svg>
                                            <span class="text-sm text-red-700">{{ $message }}</span>
                                        </div>
                                    </div>
                                @enderror

                                <!-- Upload Guidelines -->
                                <div class="mt-6 bg-gray-50 rounded-xl p-4">
                                    <h5 class="text-sm font-medium text-gray-800 mb-2">Panduan Upload:</h5>
                                    <ul class="text-sm text-gray-600 space-y-1">
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Format yang didukung: JPG, PNG, GIF, WEBP, PDF
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Ukuran maksimal: 5MB
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Resolusi tinggi untuk hasil cetak terbaik
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="catatan" class="block mb-1 text-sm font-medium text-gray-700">Catatan Order</label>
                        <textarea name="catatan" id="catatan" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Tambahkan catatan untuk pesanan Anda (opsional)">{{ old('catatan') }}</textarea>
                    </div>

                    <div class="mb-6">
                        <h2 class="pb-2 mb-4 text-xl font-semibold text-gray-700 border-b">Metode Pembayaran</h2>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input id="qris" name="payment_method" type="radio" value="qris"
                                    {{ old('payment_method') == 'qris' ? 'checked' : '' }}
                                    class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" required>
                                <label for="qris" class="block ml-3 text-sm font-medium text-gray-700">
                                    QRIS
                                </label>
                            </div>
                            {{-- <div class="flex items-center">
                            <input id="transfer" name="payment_method" type="radio" value="transfer" {{ old('payment_method') == 'transfer' ? 'checked' : '' }}
                                class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                            <label for="transfer" class="block ml-3 text-sm font-medium text-gray-700">
                                Transfer Bank
                            </label>
                        </div> --}}
                        </div>
                        @error('payment_method')
                            <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-8">
                        <button type="submit" :disabled="loading"
                            class="w-full px-4 py-3 font-medium text-white transition duration-200 bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50">
                            <span x-show="!loading">Selesaikan Pesanan</span>
                            <span x-show="loading">
                                <svg class="inline w-5 h-5 mr-3 -ml-1 text-white animate-spin"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Memproses Pesanan...
                            </span>
                        </button>
                    </div>

                </form>
            </div>

            <!-- Order Summary -->
            <div class="col-span-1">
                <div class="sticky p-6 bg-white rounded-lg shadow-lg top-8">
                    <h2 class="pb-2 mb-4 text-xl font-semibold text-gray-700 border-b">Ringkasan Pesanan</h2>
                    <div class="mb-6 space-y-4 overflow-y-auto max-h-64">
                        @if (count($cart_items) > 0)
                            @foreach ($cart_items as $index => $item)
                                <div class="flex items-center justify-between py-3 border-b">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-16 h-16 overflow-hidden bg-gray-100 rounded-md">
                                            @if (isset($item['image']))
                                                <img src="{{ asset('storage/' . $item['image']) }}"
                                                    alt="{{ $item['name'] }}"
                                                    class="object-cover object-center w-full h-full">
                                            @else
                                                <div class="flex items-center justify-center w-full h-full text-gray-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-sm font-medium text-gray-700">{{ $item['name'] }}</h3>
                                            <p class="text-xs text-gray-500">Jumlah: {{ $item['quantity'] }}</p>
                                        </div>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">
                                        Rp {{ number_format($item['unit_amount'] * $item['quantity'], 0, ',', '.') }}
                                    </span>
                                </div>
                            @endforeach
                        @else
                            <p class="py-4 text-center text-gray-500">Keranjang Anda kosong</p>
                        @endif
                    </div>

                    <div class="pt-4 space-y-2 border-t">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Subtotal</span>
                            <span class="text-sm font-medium text-gray-900">Rp
                                {{ number_format($grand_total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Pengiriman</span>
                            <span class="text-sm font-medium text-gray-900">Ditentukan kemudian</span>
                        </div>
                        <div class="flex justify-between pt-4 mt-4 border-t border-gray-200">
                            <span class="text-base font-medium text-gray-900">Total</span>
                            <span class="text-base font-bold text-indigo-600">Rp
                                {{ number_format($grand_total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="p-4 rounded-md bg-gray-50">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-gray-700">
                                        Setelah pembayaran Anda selesai, tim kami akan segera memproses pesanan Anda.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Form submit loading state
            document.querySelector('form').addEventListener('submit', function() {
                const submitBtn = document.getElementById('submit-btn');
                const submitText = document.getElementById('submit-text');
                const loadingText = document.getElementById('loading-text');

                submitBtn.disabled = true;
                submitText.classList.add('hidden');
                loadingText.classList.remove('hidden');
            });

            // File upload preview enhancement
            document.getElementById('file-upload').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Optional: Add file size validation
                    if (file.size > 5 * 1024 * 1024) { // 5MB
                        alert('File terlalu besar! Maksimal 5MB.');
                        e.target.value = '';
                        return;
                    }

                    // Optional: Add file type validation
                    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'application/pdf',
                        'image/webp'
                    ];
                    if (!allowedTypes.includes(file.type)) {
                        alert('Tipe file tidak didukung! Gunakan JPG, PNG, GIF, WEBP, atau PDF.');
                        e.target.value = '';
                        return;
                    }
                }
            });
        </script>
    @endpush
@endsection
