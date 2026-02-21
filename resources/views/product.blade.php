@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>

   <body>
    <section class="py-12 px-4">
        <div class="container mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold mb-4">Engine & <span class="text-primary">Electrical</span></h1>
                <p class="text-textsecondary max-w-2xl mx-auto">
                    Explore high-quality engine and electrical parts for better performance.
                </p>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($allproducts as $product)
                    <div class="bg-bgsecondary rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-all duration-300 product-card">
                        <a href="{{ route('productdetails',$product->slug)}}" class="block">
                            <div class="h-48 flex items-center justify-center p-4 bg-white">
                                <img src="{{ asset($product->image ?? 'images/no-image.png') }}" 
                                     alt="{{ $product->name }}" 
                                     class="h-40 object-contain">
                            </div>
                            <div class="p-5">
                                @if($product->dipper)
                                    <span class="text-xs font-semibold text-red-400 py-1 px-3 rounded-full">
                                        {{ $product->dipper }}
                                    </span>
                                @endif
                                <h3 class="text-xl font-semibold mt-3 mb-2">{{ $product->name }}</h3>
                                <p class="text-textsecondary text-sm mb-4">
                                    {{ \Illuminate\Support\Str::words(strip_tags($product->description), 9, '...') }}
                                </p>
                                <span class="text-2xl font-bold text-textprimary block mb-4">
                                    ₹{{ number_format($product->price, 2) }}
                                </span>
                            </div>
                        </a>

                        <!-- Action Buttons -->
                        <div class="px-5 pb-5 flex space-x-3">
                            <!-- Add to Cart -->
                            <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::id() ?? '1' }}">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="bg-primary hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg text-sm w-full">
                                    Add to Cart
                                </button>
                            </form>
                            
                            <form action="{{ route('buy.now') }}" method="POST" class="flex-1">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::check() ? Auth::id() : '1' }}">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg text-sm w-full">
                                    Buy Now
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">No products available.</p>
                @endforelse
            </div>
        </div>
    </section>
</body>

@endsection
