<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Shipping Notification</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 py-6">
    <div class="max-w-xl mx-auto bg-white shadow-lg rounded-2xl overflow-hidden">
        <div class="bg-indigo-600 text-white text-center py-4">
            <h1 class="text-xl font-bold">Your Order Has Been Shipped!</h1>
        </div>
        <div class="bg-indigo-600 text-white text-center py-6 mt-5">
            <img src="https://shreemillet.fillipsoftware.com/images/shri-millet.png" alt="Shri Millets"
                class="h-12 w-auto">
        </div>

        <div class="p-6">
            <p class="text-gray-700 mb-4">Hello <strong>{{ $user->name }}</strong>,</p>

            <p class="text-gray-700 mb-6">
                Great news! Your order <span class="font-semibold">#{{ $order->order_number }}</span>
                has been shipped. Here are the details:
            </p>

            <div class="bg-gray-50 border rounded-lg p-4 mb-6">
                <p><strong>Courier:</strong> {{ $shipping->courier_name }}</p>
                <p><strong>Tracking Number:</strong> {{ $shipping->tracking_number }}</p>
                <p><strong>Shipped At:</strong>
                    {{ \Carbon\Carbon::parse($shipping->shipped_at)->format('d M Y, h:i A') }}</p>
                <p><strong>Estimated Delivery:</strong>
                    {{ \Carbon\Carbon::parse($shipping->delivered_at)->format('d M Y, h:i A') }}</p>

            </div>

            <p class="text-gray-700 mb-6">
                You can track your package with the tracking number above.
                We’ll keep you updated as your order gets closer to being delivered.
            </p>

            <div class="text-center">
                <a href="{{ url('/') }}"
                    class="inline-block px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg shadow hover:bg-indigo-700 transition">
                    Continue Shopping
                </a>
            </div>
        </div>

        <div class="bg-gray-100 text-center py-4 text-sm text-gray-600">
            Thank you for shopping with us! <br>
            — The {{ config('app.name') }} Team
        </div>
    </div>
</body>

</html>
