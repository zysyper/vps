@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L9 5.414V17a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1V5.414l2.293 2.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="{{ route('my-orders') }}"
                            class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Pesanan
                            Saya</a>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="mb-6 sm:mb-8">
            <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900">My Orders</h1>
            <p class="mt-1 sm:mt-2 text-xs sm:text-sm text-gray-600">Track and manage your orders</p>
        </div>

        @if ($orders->count() > 0)
            <!-- Orders List -->
            <div class="space-y-3 sm:space-y-4">
                @foreach ($orders as $order)
                    <div
                        class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                        <!-- Mobile Compact Header -->
                        <div class="p-4 sm:p-6">
                            <!-- Order ID and Date Row -->
                            <div class="flex items-start justify-between mb-3">
                                <div class="min-w-0 flex-1">
                                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 truncate">
                                        Order #{{ $order->id }}
                                    </h3>
                                    <p class="text-xs sm:text-sm text-gray-500 mt-0.5">
                                        {{ $order->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                                <!-- Status Badges - Stacked on mobile -->
                                <div class="flex flex-col gap-1.5 ml-3 sm:flex-row sm:gap-2 sm:ml-4">
                                    <span
                                        class="inline-flex items-center justify-center px-2 py-1 rounded-full text-xs font-medium whitespace-nowrap
                                    @if ($order->status == 'delivered') bg-green-100 text-green-800
                                    @elseif($order->status == 'processing') bg-yellow-100 text-yellow-800
                                    @elseif($order->status == 'shipped') bg-blue-100 text-blue-800
                                    @elseif($order->status == 'canceled') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($order->getStatusInIndonesianAttribute()) }}
                                    </span>
                                    <span
                                        class="inline-flex items-center justify-center px-2 py-1 rounded-full text-xs font-medium whitespace-nowrap
                                    @if ($order->payment_status == 'paid') bg-green-100 text-green-800
                                    @elseif($order->payment_status == 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($order->getPaymentStatusInIndonesianAttribute()) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Order Summary -->
                            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                <!-- Order Info -->
                                <div class="flex items-center gap-2 text-xs sm:text-sm text-gray-600">
                                    <span class="inline-flex items-center">
                                        <svg class="w-3 h-3 mr-1 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                        {{ $order->items->count() }} {{ Str::plural('item', $order->items->count()) }}
                                    </span>
                                    <span class="text-gray-300">•</span>
                                    <span class="inline-flex items-center">
                                        <svg class="w-3 h-3 mr-1 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        {{ ucfirst($order->payment_method) }}
                                    </span>
                                </div>
                                <!-- Total Price -->
                                <div class="flex items-center">
                                    <span class="text-base sm:text-lg font-bold text-gray-900">
                                        {{ $order->currency ?? 'IDR' }}
                                        {{ number_format($order->grand_total, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div
                                class="flex flex-col gap-2 pt-3 mt-3 border-t border-gray-100 sm:flex-row sm:gap-3 sm:pt-4 sm:mt-4">
                                <!-- View Details Button -->
                                <a href="{{ route('orders.show', $order->id) }}"
                                    class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1 transition-colors sm:flex-1">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                    View Details
                                </a>

                                <!-- Complete Payment Button -->
                                @if ($order->status == 'new' && $order->payment_status == 'pending')
                                    <form action="{{ route('orders.payment', $order->id) }}" method="GET"
                                        class="sm:flex-1">
                                        @csrf
                                        <button type="submit"
                                            class="w-full inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1 transition-colors">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                            Pay Now
                                        </button>
                                    </form>
                                @endif

                                <!-- Cancel Order Button -->
                                @if ($order->payment_status == 'pending' && $order->status != 'canceled')
                                    <form action="{{ route('orders.cancel', $order->id) }}" method="POST"
                                        class="sm:flex-1"
                                        onsubmit="return confirm('Are you sure you want to cancel this order?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="w-full inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-red-700 bg-white border border-red-300 rounded-lg hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1 transition-colors">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Cancel Order
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6 sm:mt-8">
                {{ $orders->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="py-8 sm:py-12 text-center">
                <div class="w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 mx-auto mb-4 text-gray-400">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <h3 class="mb-2 text-base sm:text-lg font-medium text-gray-900">No orders yet</h3>
                <p class="mb-4 sm:mb-6 text-sm text-gray-500 max-w-sm mx-auto">Start shopping to see your orders here and
                    track your purchases.</p>
                <a href="{{ route('produk') }}"
                    class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1 transition-colors shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Start Shopping
                </a>
            </div>
        @endif
    </div>

    <!-- Add custom CSS for extra small screens if needed -->
    <style>
        @media (max-width: 475px) {
            .xs\:hidden {
                display: none;
            }

            .xs\:inline {
                display: inline;
            }
        }
    </style>
@endsection
