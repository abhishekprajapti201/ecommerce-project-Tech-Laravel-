@extends('admin.include.layout')

@section('heading', 'Products')
@section('title', 'Add Product')

@section('content')
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-6">Add New Product</h2>

        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Product Details --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">Product Name</label>
                    <input type="text" name="name" class="w-full border p-2 rounded" value="{{ old('name') }}"
                        required>
                    @error('name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>


                <div>
                    <label class="block mb-1 font-semibold">Discount</label>
                    <input type="number" name="discount" class="w-full border p-2 rounded" value="{{ old('name') }}"
                        required>
                    @error('discount')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                 <div>
                    <label class="block mb-1 font-semibold">Dipper</label>
                    <input type="text" name="dipper" class="w-full border p-2 rounded" value="{{ old('dipper') }}"
                        required>
                    @error('dipper')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                 <div>
                    <label class="block mb-1 font-semibold">Meterials</label>
                    <input type="text" name="meterials" step="0.01" class="w-full border p-2 rounded"
                        value="{{ old('meterials') }}" required>
                    @error('meterials')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                 <div>
                    <label class="block mb-1 font-semibold">Warranty</label>
                    <input type="text" name="warranty" step="0.01" class="w-full border p-2 rounded"
                        value="{{ old('warranty') }}" required>
                    @error('warranty')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Weight</label>
                    <input type="text" name="weight" step="0.01" class="w-full border p-2 rounded"
                        value="{{ old('weight') }}" required>
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
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div> --}}

                <div>
                    <label class="block mb-1 font-semibold">Price</label>
                    <input type="number" name="price" step="0.01" class="w-full border p-2 rounded"
                        value="{{ old('price') }}" required>
                    @error('price')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                 <div>
                    <label class="block mb-1 font-semibold">Brands</label>
                    <input type="text" name="brands" step="0.01" class="w-full border p-2 rounded"
                        value="{{ old('brands') }}" required>
                    @error('brands')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Stock</label>
                    <input type="number" name="stock" class="w-full border p-2 rounded" value="{{ old('stock') }}"
                        required>
                    @error('stock')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Main Image</label>
                    <input type="file" name="image" class="w-full border p-2 rounded">
                    @error('image')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Gallery Images</label>
                    <input type="file" name="gallery_images[]" multiple class="w-full border p-2 rounded">
                    @error('gallery_images.*')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- Product Description --}}
            <div class="mt-4">
                <label class="block mb-1 font-semibold">Description</label>
                <textarea name="description" id="product_description" rows="6" class="border rounded-md p-2 w-full">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                    <label class="block mb-1 font-semibold">CreatedBy</label>
                    <input type="text" name="create_by" step="0.01" class="w-full border p-2 rounded"
                        value="{{ old('create_by') }}" required>
                    @error('create_by')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            {{-- Product Variants --}}
            <div class="mt-6">
                <h3 class="text-xl font-bold mb-2">Product Variants</h3>
                <div id="variants-wrapper">
                    <div class="variant border p-4 mb-3 rounded bg-gray-50">
                        <label class="block mb-1 font-semibold">SKU</label>
                        <input type="text" name="variants[0][sku]" class="w-full border p-2 rounded">

                        <label class="block mt-2 mb-1 font-semibold">Price</label>
                        <input type="number" step="0.01" name="variants[0][price]" class="w-full border p-2 rounded">

                        <label class="block mt-2 mb-1 font-semibold">Stock</label>
                        <input type="number" name="variants[0][stock]" class="w-full border p-2 rounded">
                        <label class="block mt-2 mb-1 font-semibold">Small Description</label>
                        <input type="text" step="0.01" name="variants[0][small_des]" class="w-full border p-2 rounded">

                        <label class="block mt-2 mb-1 font-semibold">Image</label>
                        <input type="file" name="variants[0][image]" class="w-full border p-2 rounded">

                        {{-- Variant Options --}}
                        <div class="mt-3 options-wrapper">
                            <h4 class="font-semibold">Options</h4>
                            <div class="option flex gap-2 mb-2">
                                <input type="text" name="variants[0][options][0][name]"
                                    placeholder="Option Name (e.g. Size)" class="border p-2 rounded w-1/2">
                                <input type="text" name="variants[0][options][0][value]"
                                    placeholder="Option Value (e.g. Large)" class="border p-2 rounded w-1/2">
                            </div>
                        </div>
                        <button type="button" class="add-option bg-blue-500 text-white px-2 py-1 mt-2 rounded">+ Add
                            Option</button>
                    </div>
                </div>
                <button type="button" id="add-variant" class="bg-green-500 text-white px-3 py-2 rounded">+ Add
                    Variant</button>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save Product</button>
            </div>
        </form>
    </div>

    {{-- CKEditor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#product_description')).catch(error => {
            console.error(error);
        });

        // Dynamic Variant & Option Fields
        let variantIndex = 1;
        document.getElementById('add-variant').addEventListener('click', function() {
            const wrapper = document.getElementById('variants-wrapper');
            const newVariant = wrapper.firstElementChild.cloneNode(true);
            newVariant.querySelectorAll('input').forEach(input => input.value = '');
            newVariant.querySelectorAll('[name]').forEach(input => {
                input.name = input.name.replace(/\d+/, variantIndex);
            });
            wrapper.appendChild(newVariant);
            variantIndex++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('add-option')) {
                const optionsWrapper = e.target.previousElementSibling;
                const optionIndex = optionsWrapper.querySelectorAll('.option').length;
                const variantIdx = e.target.closest('.variant').querySelector('input[name^="variants"]').name.match(
                    /\d+/)[0];
                const newOption = document.createElement('div');
                newOption.classList.add('option', 'flex', 'gap-2', 'mb-2');
                newOption.innerHTML = `
                <input type="text" name="variants[${variantIdx}][options][${optionIndex}][name]" placeholder="Option Name" class="border p-2 rounded w-1/2">
                <input type="text" name="variants[${variantIdx}][options][${optionIndex}][value]" placeholder="Option Value" class="border p-2 rounded w-1/2">
            `;
                optionsWrapper.appendChild(newOption);
            }
        });
    </script>
@endsection
