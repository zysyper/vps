<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    <div class="w-full px-4 py-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="container mx-auto">
            <!-- Header -->
            <div class="mb-6 sm:mb-8">
                <h1 class="mb-2 text-2xl font-bold text-gray-900 sm:text-3xl lg:text-4xl">
                    Shopping Cart
                </h1>
                <p class="text-sm text-gray-600 sm:text-base">
                    Review your items and proceed to checkout
                </p>
            </div>

            @if ($hasItems)
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 lg:gap-8">
                    <!-- Cart Items Section -->
                    <div class="lg:col-span-8">
                        <div class="overflow-hidden bg-white border border-gray-100 shadow-xl rounded-2xl">
                            <div class="p-4 sm:p-6 bg-gradient-to-r from-blue-500 to-purple-600">
                                <h2 class="text-lg font-semibold text-white sm:text-xl">
                                    Your Items ({{ count($cartItems) }})
                                </h2>
                            </div>

                            <div class="divide-y divide-gray-100">
                                @foreach ($cartItems as $index => $item)
                                    <div wire:key="cart-item-{{ $item['produk_id'] }}"
                                        class="p-4 transition-colors duration-200 sm:p-6 hover:bg-gray-50">
                                        <!-- Mobile Layout -->
                                        <div class="flex flex-col space-y-4 sm:hidden">
                                            <div class="flex items-start space-x-4">
                                                <div class="flex-shrink-0">
                                                    <img class="object-cover w-16 h-16 shadow-md rounded-xl"
                                                        src="{{ $this->getProductImageUrl($item) }}"
                                                        alt="{{ $item['name'] }}">
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <h3 class="mb-1 text-sm font-semibold text-gray-900">
                                                        {{ $item['name'] }}
                                                    </h3>
                                                    <p class="text-lg font-bold text-blue-600">
                                                        {{ $currency }}{{ number_format($item['unit_amount'], 2) }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="flex items-center justify-between">
                                                <!-- Enhanced Quantity Controls -->
                                                <div class="flex items-center p-1 bg-gray-50 rounded-xl">
                                                    <button wire:click="decrementQuantity({{ $item['produk_id'] }})"
                                                        class="flex items-center justify-center w-8 h-8 text-gray-600 transition-all duration-200 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-red-50 hover:text-red-600 hover:border-red-200">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M20 12H4" />
                                                        </svg>
                                                    </button>
                                                    <input type="number" min="1" max="999"
                                                        wire:model.live="cartItems.{{ $loop->index }}.quantity"
                                                        class="w-16 px-2 py-1 text-sm font-semibold text-center text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                    <button wire:click="incrementQuantity({{ $item['produk_id'] }})"
                                                        class="flex items-center justify-center w-8 h-8 text-gray-600 transition-all duration-200 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-green-50 hover:text-green-600 hover:border-green-200">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                        </svg>
                                                    </button>
                                                </div>

                                                <div class="text-right">
                                                    <p class="mb-1 text-sm text-gray-500">Total</p>
                                                    <p class="text-lg font-bold text-gray-900">
                                                        {{ $currency }}{{ number_format($item['total_amount'], 2) }}
                                                    </p>
                                                </div>
                                            </div>

                                            <!-- Remove Button -->
                                            <button wire:click="removeItem({{ $item['produk_id'] }})"
                                                class="w-full py-2.5 px-4 bg-red-50 text-red-600 font-medium rounded-xl border border-red-200 hover:bg-red-100 hover:border-red-300 transition-all duration-200 flex items-center justify-center space-x-2"
                                                wire:loading.attr="disabled"
                                                wire:target="removeItem({{ $item['produk_id'] }})">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                <span>Remove Item</span>
                                            </button>
                                        </div>

                                        <!-- Desktop Layout -->
                                        <div class="items-center hidden space-x-6 sm:flex">
                                            <div class="flex items-center flex-1 space-x-4">
                                                <div class="flex-shrink-0">
                                                    <img class="object-cover w-20 h-20 shadow-md rounded-xl"
                                                        src="{{ $this->getProductImageUrl($item) }}"
                                                        alt="{{ $item['name'] }}">
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <h3 class="mb-2 text-lg font-semibold text-gray-900">
                                                        {{ $item['name'] }}
                                                    </h3>
                                                    <p class="text-xl font-bold text-blue-600">
                                                        {{ $currency }}{{ number_format($item['unit_amount'], 2) }}
                                                    </p>
                                                </div>
                                            </div>

                                            <!-- Enhanced Quantity Controls -->
                                            <div class="flex items-center p-1 bg-gray-50 rounded-xl">
                                                <button wire:click="decrementQuantity({{ $item['produk_id'] }})"
                                                    class="flex items-center justify-center w-10 h-10 text-gray-600 transition-all duration-200 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-red-50 hover:text-red-600 hover:border-red-200"
                                                    {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M20 12H4" />
                                                    </svg>
                                                </button>
                                                <input type="number" min="1" max="999"
                                                    wire:model.debounce.500ms="cartItems.{{ $loop->index }}.quantity"
                                                    class="w-20 px-3 py-2 text-lg font-semibold text-center text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                    wire:loading.attr="disabled">
                                                <button wire:click="incrementQuantity({{ $item['produk_id'] }})"
                                                    class="flex items-center justify-center w-10 h-10 text-gray-600 transition-all duration-200 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-green-50 hover:text-green-600 hover:border-green-200"
                                                    {{ $item['quantity'] >= 999 ? 'disabled' : '' }}>
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                    </svg>
                                                </button>
                                            </div>

                                            <div class="w-32 min-w-0 text-right">
                                                <p class="mb-1 text-sm text-gray-500">Total</p>
                                                <p class="text-xl font-bold text-gray-900">
                                                    {{ $currency }}{{ number_format($item['total_amount'], 2) }}
                                                </p>
                                            </div>

                                            <!-- Remove Button -->
                                            <button wire:click="removeItem({{ $item['produk_id'] }})"
                                                class="p-3 text-red-600 transition-all duration-200 border border-red-200 bg-red-50 rounded-xl hover:bg-red-100 hover:border-red-300"
                                                wire:loading.attr="disabled"
                                                wire:target="removeItem({{ $item['produk_id'] }})">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Summary Section -->
                    <div class="lg:col-span-4">
                        <div
                            class="sticky overflow-hidden bg-white border border-gray-100 shadow-xl rounded-2xl top-4">
                            <div class="p-4 sm:p-6 bg-gradient-to-r from-purple-500 to-pink-600">
                                <h2 class="flex items-center text-lg font-semibold text-white sm:text-xl">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    Order Summary
                                </h2>
                            </div>

                            <div class="p-6 space-y-4">
                                <div class="flex items-center justify-between py-2">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span
                                        class="font-semibold text-gray-900">{{ $currency }}{{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="flex items-center justify-between py-2">
                                    <span class="text-gray-600">Taxes</span>
                                    <span
                                        class="font-semibold text-gray-900">{{ $currency }}{{ number_format($tax, 2) }}</span>
                                </div>
                                <div class="flex items-center justify-between py-2">
                                    <span class="text-gray-600">Shipping</span>
                                    <span
                                        class="font-semibold text-gray-900">{{ $currency }}{{ number_format($shipping, 2) }}</span>
                                </div>

                                <div class="pt-4 border-t border-gray-200">
                                    <div class="flex items-center justify-between">
                                        <span class="text-lg font-bold text-gray-900">Total</span>
                                        <span
                                            class="text-2xl font-bold text-transparent bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text">
                                            {{ $currency }}{{ number_format($total, 2) }}
                                        </span>
                                    </div>
                                </div>

                                <button wire:click="checkout"
                                    class="flex items-center justify-center w-full px-6 py-4 space-x-2 font-semibold text-white transition-all duration-200 transform shadow-lg bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl hover:from-blue-700 hover:to-purple-700 hover:scale-105 hover:shadow-xl">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8" />
                                    </svg>
                                    <span>Proceed to Checkout</span>
                                </button>

                                <div class="mt-4 text-sm text-center text-gray-500">
                                    <p class="flex items-center justify-center space-x-1">
                                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        <span>Secure checkout</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty Cart State -->
                <div class="overflow-hidden bg-white border border-gray-100 shadow-xl rounded-2xl">
                    <div class="p-8 text-center sm:p-12">
                        <div class="flex items-center justify-center w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8" />
                            </svg>
                        </div>

                        <h2 class="mb-4 text-xl font-bold text-gray-900 sm:text-2xl">
                            Your cart is empty
                        </h2>
                        <p class="max-w-md mx-auto mb-8 text-gray-600">
                            Looks like you haven't added any products to your cart yet. Start shopping to fill it up!
                        </p>

                        <a href="{{ route('produk') }}"
                            class="inline-flex items-center px-8 py-4 space-x-2 font-semibold text-white transition-all duration-200 transform shadow-lg bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl hover:from-blue-700 hover:to-purple-700 hover:scale-105 hover:shadow-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <span>Continue Shopping</span>
                        </a>
                    </div>
                </div>
            @endif

            @if ($message)
                <div class="p-4 mt-6 border border-green-200 bg-green-50 rounded-xl">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="font-medium text-green-800">{{ $message }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
