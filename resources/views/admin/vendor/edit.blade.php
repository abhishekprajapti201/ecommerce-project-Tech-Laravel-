@extends('admin.include.layout')

@section('heading', 'Products')
@section('title', 'Edit Product')

@section('content')
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-6">Edit Product</h2>

        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf


            {{-- Product Details --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">Product Name</label>
                    <input type="text" name="name" class="w-full border p-2 rounded"
                        value="{{ old('name', $product->name) }}" required>
                    @error('name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>



                <div>
                    <label class="block mb-1 font-semibold">Dipper</label>
                    <input type="text" name="dipper" class="w-full border p-2 rounded"
                        value="{{ old('dipper', $product->dipper) }}" required>
                    @error('dipper')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Meterials</label>
                    <input type="text" name="meterials" step="0.01" class="w-full border p-2 rounded"
                        value="{{ old('meterials', $product->meterials) }}" required>
                    @error('meterials')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Warranty</label>
                    <input type="text" name="warranty" step="0.01" class="w-full border p-2 rounded"
                        value="{{ old('warranty', $product->warranty) }}" required>
                    @error('warranty')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Weight</label>
                    <input type="text" name="weight" step="0.01" class="w-full border p-2 rounded"
                        value="{{ old('weight', $product->weight) }}" required>
                    @error('weight')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>


                {{-- 
            <div>
                <label class="block mb-1 font-semibold">Category</label>
                <select name="category_id" class="w-full border p-2 rounded">
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div> --}}

                <div>
                    <label class="block mb-1 font-semibold">Price</label>
                    <input type="number" name="price" step="0.01" class="w-full border p-2 rounded"
                        value="{{ old('price', $product->price) }}" required>
                    @error('price')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

<div>
                    <label class="block mb-1 font-semibold">Discount</label>
                    <input type="number" name="discount" class="w-full border p-2 rounded" value="{{ old('discount',$product->discount) }}"
                        required>
                    @error('discount')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Brands</label>
                    <input type="text" name="brands" step="0.01" class="w-full border p-2 rounded"
                        value="{{ old('brands', $product->brands) }}" required>
                    @error('brands')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Stock</label>
                    <input type="number" name="stock" class="w-full border p-2 rounded"
                        value="{{ old('stock', $product->stock) }}" required>
                    @error('stock')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Main Image</label>
                    <input type="file" name="image" class="w-full border p-2 rounded">
                    @if ($product->image)
                        <img src="{{ asset($product->image) }}" class="w-24 mt-2 rounded">
                    @endif
                    @error('image')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Gallery Images</label>
                    <input type="file" name="gallery_images[]" multiple class="w-full border p-2 rounded">
                    @if ($product->gallery_images)
                        @foreach (json_decode($product->gallery_images, true) as $gImage)
                            <img src="{{ asset($gImage) }}" class="w-24 mt-2 rounded inline-block">
                        @endforeach
                    @endif
                    @error('gallery_images.*')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Product Description --}}
            <div class="mt-4">
                <label class="block mb-1 font-semibold">Description</label>
                <textarea name="description" id="product_description" rows="6" class="border rounded-md p-2 w-full">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-semibold">CreatedBy</label>
                <input type="text" name="create_by" step="0.01" class="w-full border p-2 rounded"
                    value="{{ old('create_by', $product->create_by) }}" required>
                @error('create_by')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Product Variants --}}
            <div class="mt-6">
                <h3 class="text-xl font-bold mb-2">Product Variants</h3>
                <div id="variants-wrapper">
                    @foreach ($product->variants as $vIndex => $variant)
                        <div class="variant border p-4 mb-3 rounded bg-gray-50 relative">
                            <button type="button" class="remove-variant absolute top-2 right-2 text-red-600">✖</button>

                            <label class="block mb-1 font-semibold">SKU</label>
                            <input type="text" name="variants[{{ $vIndex }}][sku]"
                                class="w-full border p-2 rounded" value="{{ old("variants.$vIndex.sku", $variant->sku) }}">

                            <label class="block mt-2 mb-1 font-semibold">Price</label>
                            <input type="number" step="0.01" name="variants[{{ $vIndex }}][price]"
                                class="w-full border p-2 rounded"
                                value="{{ old("variants.$vIndex.price", $variant->price) }}">

                            <label class="block mt-2 mb-1 font-semibold">Stock</label>
                            <input type="number" name="variants[{{ $vIndex }}][stock]"
                                class="w-full border p-2 rounded"
                                value="{{ old("variants.$vIndex.stock", $variant->stock) }}">

                            <label class="block mt-2 mb-1 font-semibold">Small Description</label>
                            <input type="text" step="0.01" name="variants[{{ $vIndex }}][small_des]"
                                class="w-full border p-2 rounded" value="{{ old("variants.$vIndex.small_des",$variant->small_des) }}">

                            <label class="block mt-2 mb-1 font-semibold">Image</label>
                            <input type="file" name="variants[{{ $vIndex }}][image]"
                                class="w-full border p-2 rounded">
                            @if ($variant->image)
                                <img src="{{ asset('storage/' . $variant->image) }}" class="w-16 mt-2 rounded">
                            @endif

                            {{-- Variant Options --}}
                            <div class="mt-3 options-wrapper">
                                <h4 class="font-semibold">Options</h4>
                                @foreach ($variant->options as $oIndex => $option)
                                    <div class="option flex gap-2 mb-2 relative">
                                        <input type="text"
                                            name="variants[{{ $vIndex }}][options][{{ $oIndex }}][name]"
                                            value="{{ old("variants.$vIndex.options.$oIndex.name", $option->name) }}"
                                            placeholder="Option Name" class="border p-2 rounded w-1/2">
                                        <input type="text"
                                            name="variants[{{ $vIndex }}][options][{{ $oIndex }}][value]"
                                            value="{{ old("variants.$vIndex.options.$oIndex.value", $option->value) }}"
                                            placeholder="Option Value" class="border p-2 rounded w-1/2">
                                        <button type="button"
                                            class="remove-option absolute right-0 top-0 text-red-600">✖</button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="add-option bg-blue-500 text-white px-2 py-1 mt-2 rounded">+ Add
                                Option</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-variant" class="bg-green-500 text-white px-3 py-2 rounded">+ Add
                    Variant</button>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Product</button>
            </div>
        </form>
    </div>

    {{-- CKEditor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#product_description')).catch(error => {
            console.error(error);
        });

        // Variant logic
        let variantIndex = {{ count($product->variants) }};
        document.getElementById('add-variant').addEventListener('click', function() {
            const wrapper = document.getElementById('variants-wrapper');
            const firstVariant = wrapper.firstElementChild;
            const newVariant = firstVariant.cloneNode(true);

            // Reset inputs
            newVariant.querySelectorAll('input').forEach(input => input.value = '');

            // Update input names
            newVariant.querySelectorAll('[name]').forEach(input => {
                input.name = input.name.replace(/variants\[\d+\]/, `variants[${variantIndex}]`);
            });

            wrapper.appendChild(newVariant);
            variantIndex++;
        });

        // Add option
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('add-option')) {
                const variantBlock = e.target.closest('.variant');
                const optionsWrapper = variantBlock.querySelector('.options-wrapper');
                const optionIndex = optionsWrapper.querySelectorAll('.option').length;
                const variantIdx = variantBlock.querySelector('input[name^="variants"]').name.match(
                    /variants\[(\d+)\]/)[1];

                const newOption = document.createElement('div');
                newOption.classList.add('option', 'flex', 'gap-2', 'mb-2', 'relative');
                newOption.innerHTML = `
                <input type="text" name="variants[${variantIdx}][options][${optionIndex}][name]" placeholder="Option Name" class="border p-2 rounded w-1/2">
                <input type="text" name="variants[${variantIdx}][options][${optionIndex}][value]" placeholder="Option Value" class="border p-2 rounded w-1/2">
                <button type="button" class="remove-option absolute right-0 top-0 text-red-600">✖</button>
            `;
                optionsWrapper.appendChild(newOption);
            }

            // Remove variant
            if (e.target.classList.contains('remove-variant')) {
                const variantBlock = e.target.closest('.variant');
                if (document.querySelectorAll('.variant').length > 1) {
                    variantBlock.remove();
                } else {
                    alert('At least one variant is required.');
                }
            }

            // Remove option
            if (e.target.classList.contains('remove-option')) {
                const optionBlock = e.target.closest('.option');
                optionBlock.remove();
            }
        });
    </script>
@endsection
