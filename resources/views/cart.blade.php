@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<script src="https://cdn.tailwindcss.com"></script>
<script src="//unpkg.com/alpinejs" defer></script>

<div class="bg-green-50 min-h-screen py-10 px-4 md:px-10">
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Left Column: Cart Items -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Shopping Cart Card -->
            <div class="bg-white shadow rounded-2xl p-6">
                <h2 class="text-lg font-semibold mb-4">
                    Shopping Cart 
                    <span class="text-gray-500 text-sm">
                        ({{ count($cartItems) }} item{{ count($cartItems) > 1 ? 's' : '' }})
                    </span>
                </h2>

                @forelse ($cartItems as $cart)
                <div 
                    x-data="cartItem({{ $cart->id }}, {{ $cart->quantity }}, {{ $cart->product->price }})" 
                    class="flex flex-col sm:flex-row items-start sm:items-center justify-between border-b pb-4 mb-4"
                >
                    <!-- Product Image + Info -->
                    <div class="flex items-center space-x-4">
                        <img src="{{ asset($cart->product->image ?? 'https://via.placeholder.com/100x100.png') }}" 
                             alt="{{ $cart->product->name }}" 
                             class="rounded-md w-24 h-24 object-cover">
                        <div>
                            <h3 class="text-gray-800 font-semibold">{{ $cart->product->name }}</h3>
                            <p class="text-sm text-gray-500">Weight: {{ $cart->product->weight ?? 'N/A' }}</p>
                            <div class="flex items-center mt-1 text-yellow-500">
                                {!! str_repeat('★', floor($cart->product->rating ?? 4)) !!}
                                {!! str_repeat('☆', 5 - floor($cart->product->rating ?? 4)) !!}
                                <span class="text-gray-500 ml-2 text-sm">({{ $cart->product->rating ?? '4.7' }})</span>
                            </div>
                        </div>
                    </div>

                    <!-- Price + Quantity + Actions -->
                    <div class="flex flex-col items-end space-y-2 mt-4 sm:mt-0">
                        <!-- Item Total -->
                        <div class="text-lg font-semibold text-gray-800">
                            ₹<span x-text="itemTotal.toFixed(2)">{{ number_format($cart->product->price * $cart->quantity, 2) }}</span>
                            @if($cart->product->original_price && $cart->product->original_price > $cart->product->price)
                                <span class="text-gray-400 line-through text-sm ml-1">
                                    ₹{{ number_format($cart->product->original_price, 2) }}
                                </span>
                            @endif
                        </div>

                        <!-- Quantity Selector -->
                        <div class="flex items-center border rounded-lg overflow-hidden">
                            <button @click="decrement()" class="px-3 py-1 text-gray-600 hover:bg-gray-100">-</button>
                            <input type="text" x-model="quantity" class="w-10 text-center border-0 focus:ring-0">
                            <button @click="increment()" class="px-3 py-1 text-gray-600 hover:bg-gray-100">+</button>
                        </div>

                        <!-- Save / Remove Buttons -->
                        <div class="flex items-center space-x-4 text-sm">
                            <form action="" method="POST">
                                @csrf
                                <button type="submit" class="text-green-600 flex items-center space-x-1 hover:underline">
                                    <span>💚</span><span>Save for later</span>
                                </button>
                            </form>
                            <a href="{{ url('cart/delete', $cart->id) }}" 
                               class="text-red-600 flex items-center space-x-1 hover:underline">
                                <span>🗑️</span><span>Remove</span>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center text-gray-500">Your cart is empty.</p>
                @endforelse

                <!-- Continue Shopping / Clear Cart -->
                <div class="flex justify-between text-sm mt-6">
                    <a href="{{ url('/product') }}" class="text-green-600 hover:underline">← Continue Shopping</a>
                    <form action="" method="POST">
                        @csrf
                        <button type="submit" class="text-red-600 hover:underline flex items-center">
                            🗑️ Clear Cart
                        </button>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="bg-white shadow rounded-xl p-4 flex items-start space-x-3">
                    <div class="text-blue-500 text-2xl">🚚</div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Free Shipping</h4>
                        <p class="text-sm text-gray-500">Orders above ₹999 qualify for free delivery. Estimated time: 3-5 business days.</p>
                    </div>
                </div>

                <div class="bg-white shadow rounded-xl p-4 flex items-start space-x-3">
                    <div class="text-green-500 text-2xl">🔄</div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Easy Returns</h4>
                        <p class="text-sm text-gray-500">30-day return policy. Free return shipping on all items.</p>
                    </div>
                </div>
            </div>

            <!-- Recommendations -->
            <div class="bg-white shadow rounded-2xl p-6">
                <h3 class="text-lg font-semibold mb-4">You might also like</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @foreach ([
                    ['name' => 'Blood Pressure Monitor', 'price' => '₹1,299', 'img' => 'https://via.placeholder.com/200x150.png?text=BP+Monitor'],
                    ['name' => 'Infrared Thermometer', 'price' => '₹999', 'img' => 'https://via.placeholder.com/200x150.png?text=Thermometer'],
                    ['name' => 'Pulse Oximeter', 'price' => '₹799', 'img' => 'https://via.placeholder.com/200x150.png?text=Oximeter']
                    ] as $item)
                    <div class="border rounded-xl p-4 flex flex-col items-center">
                        <img src="{{ $item['img'] }}" alt="{{ $item['name'] }}" class="rounded-md mb-2 w-full h-32 object-cover">
                        <h4 class="font-medium text-gray-800">{{ $item['name'] }}</h4>
                        <p class="text-sm text-gray-600 mb-2">{{ $item['price'] }}</p>
                        <button class="bg-green-600 text-white px-4 py-1.5 rounded-md hover:bg-green-700">Add to Cart</button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right Column: Order Summary -->
        <div class="bg-white shadow rounded-2xl p-6 h-fit">
            <h3 class="text-lg font-semibold mb-4">Order Summary</h3>

            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span>Subtotal ({{ count($cartItems) }} item{{ count($cartItems) > 1 ? 's' : '' }})</span>
                    <span id="cart-total">₹{{ $cartItems->sum(fn($c) => $c->quantity * $c->product->price) }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Shipping</span><span class="text-green-600">Free</span>
                </div>
                <div class="flex justify-between">
                    <span>Tax</span><span id="tax">₹180</span>
                </div>
            </div>

            <div class="border-t mt-3 pt-3 flex justify-between font-semibold">
                <span>Total</span>
                <span id="cart-total-final">
                    ₹{{ $cartItems->sum(fn($c) => $c->quantity * $c->product->price) + 180 }}
                </span>
            </div>

           <form action="{{ route('order.confirm') }}" method="POST">
            @csrf
             <button type="submit" class="w-full mt-4 bg-green-600 text-white py-2 rounded-md hover:bg-green-700">
                Place Order
            </button>
           </form>
        </div>
    </div>
</div>

<!-- Alpine Cart Logic -->
<script>
function cartItem(cartId, initialQty, price) {
    return {
        quantity: initialQty,
        itemTotal: price * initialQty,
        increment() {
            this.quantity++;
            this.updateQuantity();
        },
        decrement() {
            if (this.quantity > 1) {
                this.quantity--;
                this.updateQuantity();
            }
        },
        updateQuantity() {
            fetch("{{ route('cart.updateQuantity') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    cart_id: cartId,
                    quantity: this.quantity
                })
            })
            .then(res => res.json())
            .then(res => {
                if (res.status === 'success') {
                    this.itemTotal = parseFloat(res.item_total_price);
                    document.getElementById('cart-total').textContent = '₹' + res.cart_total;
                    document.getElementById('cart-total-final').textContent = '₹' + res.cart_total;
                    
                }
            });
        }
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: "{{ session('success') }}",
    showConfirmButton: false,
    timer: 2000
});
</script>
@endif
@endsection
