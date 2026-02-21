
@php
    print_r($products);
@endphp
<div class="bg-bgsecondary rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-all duration-300 product-card">
    <a href="{{ route('productdetails'$) }}" class="block">
        <div class="h-48 {{ $bgColor }} flex items-center justify-center p-4">
            <img src="{{ $image }}" alt="{{ $title }}" class="h-40 object-contain">
        </div>
        <div class="p-5">
            <span class="text-xs font-semibold {{ $badgeColor }} py-1 px-3 rounded-full">
                {{ $category }}
            </span>
            <h3 class="text-xl font-semibold mt-3 mb-2">{{ $title }}</h3>
            <p class="text-textsecondary text-sm mb-4">{{ $description }}</p>
            <span class="text-2xl font-bold text-textprimary block mb-4">₹{{ $price }}</span>
        </div>
    </a>

    <!-- Buttons -->
    <div class="px-5 pb-5 flex space-x-3">
        <a href="{{ route('cart') }}"
            class="bg-primary hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg text-sm w-1/2 text-center">
            Add to Cart
        </a>
        <a href="{{ route('productdetails') }}"
            class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg text-sm w-1/2 text-center">
            Buy Now
        </a>
    </div>
</div>