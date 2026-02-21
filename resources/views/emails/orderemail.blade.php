<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="max-w-xl mx-auto mt-10 bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-indigo-600 text-white text-center py-6">
            <h1 class="text-2xl font-bold">✅ Order Confirmed</h1>
        </div>

        <div class="bg-indigo-600 text-white text-center py-6 mt-5">
           <img src="https://charatbox.fillipsoftware.com/images/logo.jpeg" alt="Shri Millets" class="h-12 w-auto" style="width: 200px">
        </div>

        <!-- Content -->
        <div class="p-8 text-gray-800">
            <h2 class="text-xl font-semibold mb-2">Hello {{ $order->user->name }},</h2>
            <p class="mb-4">Thank you for shopping with <span class="font-bold">Your Shop Name</span>. Your order has been successfully confirmed!</p>

            <!-- Order Summary -->
            <div class="bg-gray-100 p-4 rounded-lg mb-6">
                <p><span class="font-semibold">Order ID:</span> #{{ $order->id }}</p>
                <p><span class="font-semibold">Total Amount:</span> ₹{{ $order->total_amount }}</p>
            </div>

            {{-- <p class="mb-6">We’ll notify you once your package is shipped. You can track your order anytime from your account.</p>

            {{-- <!-- CTA Button -->
            <div class="text-center">
                <a href="{{ url('/orders/'.$order->id) }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold shadow hover:bg-indigo-700 transition">View Order</a>
            </div> --}}
        </div>

        <!-- Footer -->
        <div class="bg-gray-50 text-center py-4 text-sm text-gray-500">
            © {{ date('Y') }} Your Shop Name. All rights reserved.
        </div>
    </div>
</body>
</html>
