@extends('layouts.app')

@section('content')
    <style>
        :root {
            --color-primary: 14 165 233;
            /* blue-500 */
            --color-secondary: 34 197 94;
            /* green-500 */
            --color-accent: 249 115 22;
            /* orange-500 */
            --color-neutral: 100 116 139;
            /* slate-500 */

            --bg-primary: 248 250 252;
            /* slate-50 */
            --bg-secondary: 255 255 255;
            /* white */

            --text-primary: 15 23 42;
            /* slate-900 */
            --text-secondary: 100 116 139;
            /* slate-500 */
        }

        body {
            background-color: rgb(var(--bg-primary));
            color: rgb(var(--text-primary));
        }

        .btn-primary {
            background-color: rgb(var(--color-primary));
            color: white;
        }

        .btn-primary:hover {
            background-color: rgb(2 132 199);
            /* blue-600 */
        }

        .btn-outline {
            border: 1px solid rgb(var(--color-primary));
            color: rgb(var(--color-primary));
        }

        .btn-outline:hover {
            background: rgb(239 246 255);
        }

        .highlight-icon {
            color: rgb(var(--color-secondary));
        }

        .badge-discount {
            background: rgb(var(--color-secondary) / 0.1);
            color: rgb(var(--color-secondary));
        }

        .tab-active {
            border-bottom: 2px solid rgb(var(--color-primary));
            color: rgb(var(--color-primary));
        }
    </style>

    <body class="font-sans">
        @php
            $products = $product_details;
        @endphp
        <!-- Product Section -->
        <section class="container mx-auto px-4 py-10 grid grid-cols-1 lg:grid-cols-2 gap-10">

            <!-- Product Image Gallery -->
            <div>
                <div class="border rounded-lg overflow-hidden bg-white">
                    <img id="mainImage" src="{{ asset($products->image) }}" alt="Product"
                        class="w-full h-[450px] object-contain">
                </div>
                @php

                    $galleryImages = json_decode($products->gallery_images, true);
                @endphp

                @if (!empty($galleryImages))
                    <div class="flex gap-4 mt-4">
                        @foreach ($galleryImages as $image)
                            <img src="{{ asset($image) }}" alt="Product Image"
                                class="thumb w-20 h-20 object-contain border rounded-lg cursor-pointer">
                        @endforeach
                    </div>
                @endif

            </div>

            <!-- Product Details -->
            <div>
                <h1 class="text-2xl md:text-3xl font-bold mb-3">{{ $products->name }}</h1>
                @php
                    function generateSKUFromName($name)
                    {
                        $prefix = strtoupper(substr($name, 0, 3));
                        $randomNumber = rand(1000, 9999);
                        return $prefix . '-' . $randomNumber;
                    }
                @endphp
                <p class="text-sm text-gray-500 mb-2">SKU: {{ generateSKUFromName($products->name) }}</p>

                <!-- Price -->
                <div class="flex items-center space-x-3 mb-4">
                    <p class="text-2xl font-bold text-[rgb(var(--color-accent))]">₹{{ $products->price }}</p>
                    <p class="text-lg line-through text-gray-400">₹{{ $products->original_price }}</p>
                    <span class="badge-discount px-2 py-1 text-sm rounded">{{ $products->discount }}% OFF</span>
                </div>

                <!-- Highlights -->
                <ul class="space-y-2 mb-6">
                    <li class="flex items-center">
                        <i class="fas fa-check highlight-icon mr-2"></i> High quality material
                    </li>
                    <li class="flex items-center"><i class="fas fa-check highlight-icon mr-2"></i> Direct fit for Honda CBR
                        250</li>
                    <li class="flex items-center"><i class="fas fa-check highlight-icon mr-2"></i> Long-lasting performance
                    </li>
                </ul>

                <!-- Quantity Selector -->
                {{-- <div class="flex items-center mb-6">
                    <span class="mr-3 font-medium">Quantity:</span>
                    <button id="decrease" class="px-3 py-1 border rounded-l bg-gray-100">-</button>
                    <input type="text" id="quantity" value="1" class="w-12 text-center border-t border-b">
                    <button id="increase" class="px-3 py-1 border rounded-r bg-gray-100">+</button>
                </div> --}}

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 mb-8">
                    {{-- Add to Cart --}}
                    <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::check() ? Auth::id() :'1' }}">
                        <input type="hidden" name="product_id" value="{{ $products->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium transition duration-200">
                            Add to Cart
                        </button>
                    </form>

                    {{-- Buy Now --}}
                    <form action="{{ route('buy.now') }}" method="POST" class="flex-1">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::check() ? Auth::id():'1' }}">
                        <input type="hidden" name="product_id" value="{{ $products->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit"
                            class="w-full border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white py-3 rounded-lg font-medium transition duration-200">
                            Buy Now
                        </button>
                    </form>
                </div>


                <!-- Delivery Info -->
                <div class="bg-gray-100 p-4 rounded-lg space-y-2">
                    <p><i class="fas fa-truck text-[rgb(var(--color-accent))] mr-2"></i> Free delivery on orders above ₹999
                    </p>
                    <p><i class="fas fa-undo text-[rgb(var(--color-accent))] mr-2"></i> 7 Days Return Policy</p>
                    <p><i class="fas fa-shield-alt text-[rgb(var(--color-accent))] mr-2"></i> Secure Payment</p>
                </div>
            </div>
        </section>

        <!-- Tabs: Description / Additional Info / Reviews -->
        <section class="container mx-auto px-4 pb-12">
            <div class="border-b mb-6">
                <nav class="flex space-x-8">
                    <button class="tab-btn py-2 px-4 tab-active">Description</button>
                    <button class="tab-btn py-2 px-4 text-gray-600">Additional Info</button>
                    <button class="tab-btn py-2 px-4 text-gray-600">Reviews</button>
                </nav>
            </div>

            <div id="tab-content" class="text-gray-700 leading-relaxed">
                <p>

                </p>
            </div>
        </section>

        <!-- Related Products -->
        <section class="container mx-auto px-4 pb-12">
            <h2 class="text-xl font-bold mb-6">Related Products</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Product Card -->

                @foreach ($products->variants as $variant)
                    <div class="bg-white shadow rounded-lg p-4 hover:shadow-lg transition">
                        <img src="{{ asset($variant->image) }}" alt="Product" class="w-full h-40 object-contain mb-3">
                        <h3 class="font-medium text-sm">{{ $variant->small_des }}</h3>
                        <p class="text-[rgb(var(--color-accent))] font-bold mt-2">₹{{ $variant->price }}</p>
                    </div>
                @endforeach


            </div>
        </section>

        <!-- JS -->
        <script>
            // Image gallery
            const mainImage = document.getElementById("mainImage");
            document.querySelectorAll(".thumb").forEach(img => {
                img.addEventListener("click", () => {
                    mainImage.src = img.src;
                });
            });

            // Quantity buttons (safe check: only run if elements exist)
            const qty = document.getElementById("quantity");
            if (qty) {
                const increaseBtn = document.getElementById("increase");
                const decreaseBtn = document.getElementById("decrease");

                increaseBtn.onclick = () => qty.value = parseInt(qty.value) + 1;
                decreaseBtn.onclick = () => {
                    if (parseInt(qty.value) > 1) qty.value = parseInt(qty.value) - 1;
                };
            }

            // Tabs
            const tabs = document.querySelectorAll(".tab-btn");
            const tabContent = document.getElementById("tab-content");
            const contents = [
                `<p>{!! $products->description !!}</p>`,
                `<ul class="list-disc pl-5 space-y-2">
            <li>Brand: {{ $products->brands }}</li>
            <li>Compatible Bike: Honda CBR 250</li>
            <li>Material: {{ $products->meterials }}</li>
            <li>Warranty: {{ $products->warranty }}</li>
            <li>Weight: {{ $products->weight }}</li>
            <li>Made in {{ $products->create_by }}</li>
        </ul>`,
                `<div class="space-y-4">
            <p><strong>Rohan Kumar</strong> ⭐⭐⭐⭐⭐ <br> "Perfect fit for my CBR 250, quality is excellent!"</p>
            <p><strong>Amit Singh</strong> ⭐⭐⭐⭐ <br> "Good product, delivery was fast. Packaging could be better."</p>
        </div>`
            ];
            tabs.forEach((tab, i) => {
                tab.addEventListener("click", () => {
                    tabs.forEach(t => t.classList.remove("tab-active"));
                    tab.classList.add("tab-active");
                    tabContent.innerHTML = contents[i];
                });
            });
        </script>
    </body>
@endsection
