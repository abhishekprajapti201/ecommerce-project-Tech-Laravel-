<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use App\Models\VariantOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Show Add Product Form
    public function create()
    {
        $categories = Category::all();
        return view('admin.venue.create', compact('categories'));
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'brands'            => 'required|string|max:255',
            'weight'            => 'required',
            'meterials'         => 'required|string|max:255',
            'dipper'            => 'nullable|string|max:255',
            'warranty'          => 'required|string|max:255',
            'create_by'         => 'required|string|max:255',
            'discount'          => 'nullable|numeric|min:0|max:100',
            'category_id'       => 'nullable|exists:categories,id',
            'price'             => 'required|numeric|min:0',
            'stock'             => 'required|integer|min:0',
            'description'       => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png',
            'gallery_images'    => 'nullable|array',
            'gallery_images.*'  => 'nullable|image|mimes:jpg,jpeg,png',
            'variants'                      => 'nullable|array',
            'variants.*.sku'                => 'nullable|string|max:255',
            'variants.*.price'              => 'nullable|numeric|min:0',
            'variants.*.stock'              => 'nullable|integer|min:0',
            'variants.*.small_des'          => 'nullable|string|max:1000',
            'variants.*.image'              => 'nullable|image|mimes:jpg,jpeg,png',
            'variants.*.options'            => 'nullable|array',
            'variants.*.options.*.name'     => 'nullable|string|max:255',
            'variants.*.options.*.value'    => 'nullable|string|max:255',
        ]);

       
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $i = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$i}";
            $i++;
        }

     
        $price = $request->price;
        $discount = $request->discount ?? 0;
        $finalPrice = $discount > 0 ? $price * (1 - $discount / 100) : $price;

        
        $product = new Product([
            'name'           => $request->name,
            'brands'         => $request->brands,
            'weight'         => $request->weight,
            'meterials'      => $request->meterials,
            'create_by'      => $request->create_by,
            'dipper'         => $request->dipper,
            'warranty'       => $request->warranty,
            'discount'       => $discount,
            'category_id'    => $request->category_id,
            'slug'           => $slug,
            'price'          => $finalPrice,
            'original_price' => $price,
            'stock'          => $request->stock,
            'description'    => $request->description,
        ]);

        // Main Image
        if ($request->hasFile('image')) {
            $imageName = time() . '-' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);
            $product->image = 'uploads/products/' . $imageName;
        }

        // Gallery Images
        if ($request->hasFile('gallery_images')) {
            $galleryPaths = [];
            foreach ($request->file('gallery_images') as $galleryImage) {
                $galleryName = time() . '-' . uniqid() . '.' . $galleryImage->extension();
                $galleryImage->move(public_path('uploads/products/gallery'), $galleryName);
                $galleryPaths[] = 'uploads/products/gallery/' . $galleryName;
            }
            $product->gallery_images = json_encode($galleryPaths);
        }

        $product->save();

        // Variants
        if ($request->filled('variants')) {
            foreach ($request->variants as $variantData) {
                $variant = new ProductVariant();
                $variant->product_id = $product->id;

                // SKU unique check
                $sku = $variantData['sku'] ?? 'SKU-' . strtoupper(Str::random(6));
                $originalSku = $sku;
                $j = 1;
                while (ProductVariant::where('sku', $sku)->exists()) {
                    $sku = "{$originalSku}-{$j}";
                    $j++;
                }

                $variant->sku = $sku;
                $variant->price = $variantData['price'] ?? 0;
                $variant->stock = $variantData['stock'] ?? 0;
                $variant->small_des = $variantData['small_des'] ?? null;

                // Variant Image
                if (!empty($variantData['image']) && $variantData['image'] instanceof \Illuminate\Http\UploadedFile) {
                    $variantImage = time() . '-' . uniqid() . '.' . $variantData['image']->extension();
                    $variantData['image']->move(public_path('uploads/variants'), $variantImage);
                    $variant->image = 'uploads/variants/' . $variantImage;
                }

                $variant->save();

                // Variant Options
                if (!empty($variantData['options'])) {
                    foreach ($variantData['options'] as $opt) {
                        VariantOption::create([
                            'variant_id' => $variant->id,
                            'name'       => $opt['name'] ?? '',
                            'value'      => $opt['value'] ?? '',
                        ]);
                    }
                }
            }
        }

        return redirect()->route('poducts.listing')->with('success', 'Product created successfully!');
    }

   
    public function product_update(Request $request, $id)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'brands'            => 'required|string|max:255',
            'weight'            => 'required',
            'meterials'         => 'required|string|max:255',
            'dipper'            => 'nullable|string|max:255',
            'warranty'          => 'required|string|max:255',
            'create_by'         => 'required|string|max:255',
            'discount'          => 'nullable|numeric|min:0|max:100',
            'category_id'       => 'nullable|exists:categories,id',
            'price'             => 'required|numeric|min:0',
            'stock'             => 'required|integer|min:0',
            'description'       => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png',
            'gallery_images'    => 'nullable|array',
            'gallery_images.*'  => 'nullable|image|mimes:jpg,jpeg,png',
            'variants'                      => 'nullable|array',
            'variants.*.id'                 => 'nullable|exists:product_variants,id',
            'variants.*.sku'                => 'nullable|string|max:255',
            'variants.*.price'              => 'nullable|numeric|min:0',
            'variants.*.stock'              => 'nullable|integer|min:0',
            'variants.*.small_des'          => 'nullable|string|max:1000',
            'variants.*.image'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'variants.*.options'            => 'nullable|array',
            'variants.*.options.*.id'       => 'nullable|exists:variant_options,id',
            'variants.*.options.*.name'     => 'nullable|string|max:255',
            'variants.*.options.*.value'    => 'nullable|string|max:255',
        ]);

        $product = Product::findOrFail($id);

        // Handle pricing changes
        $discount = $request->discount ?? $product->discount ?? 0;
        $originalPrice = $request->price ?? $product->original_price;
        $finalPrice = $discount > 0 ? $originalPrice * (1 - $discount / 100) : $originalPrice;

        $product->fill([
            'name'           => $request->name,
            'brands'         => $request->brands,
            'weight'         => $request->weight,
            'create_by'      => $request->create_by,
            'dipper'         => $request->dipper,
            'warranty'       => $request->warranty,
            'discount'       => $discount,
            'meterials'      => $request->meterials,
            'category_id'    => $request->category_id,
            'original_price' => $originalPrice,
            'price'          => $finalPrice,
            'stock'          => $request->stock,
            'description'    => $request->description,
        ]);

  
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $i = 1;
        while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
            $slug = "{$originalSlug}-{$i}";
            $i++;
        }
        $product->slug = $slug;

        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            $imageName = time() . '-' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);
            $product->image = 'uploads/products/' . $imageName;
        }

        // Gallery images
        if ($request->hasFile('gallery_images')) {
            $galleryPaths = [];
            foreach ($request->file('gallery_images') as $galleryImage) {
                $galleryName = time() . '-' . uniqid() . '.' . $galleryImage->extension();
                $galleryImage->move(public_path('uploads/products/gallery'), $galleryName);
                $galleryPaths[] = 'uploads/products/gallery/' . $galleryName;
            }
            $existing = json_decode($product->gallery_images, true) ?? [];
            $product->gallery_images = json_encode(array_merge($existing, $galleryPaths));
        }

        $product->save();

        /** ---------------- VARIANTS UPDATE ---------------- */
        $existingVariantIds = $product->variants()->pluck('id')->toArray();
        $incomingVariantIds = [];

        if ($request->filled('variants')) {
            foreach ($request->variants as $variantData) {
                $variant = !empty($variantData['id'])
                    ? ProductVariant::find($variantData['id'])
                    : new ProductVariant(['product_id' => $product->id]);

                if (!$variant) continue;

                $sku = $variantData['sku'] ?? 'SKU-' . strtoupper(Str::random(6));
                $originalSku = $sku;
                $j = 1;
                while (ProductVariant::where('sku', $sku)->where('id', '!=', $variant->id)->exists()) {
                    $sku = "{$originalSku}-{$j}";
                    $j++;
                }

                $variant->fill([
                    'sku'        => $sku,
                    'price'      => $variantData['price'] ?? 0,
                    'stock'      => $variantData['stock'] ?? 0,
                    'small_des'  => $variantData['small_des'] ?? null,
                ]);

               
                if (!empty($variantData['image']) && $variantData['image'] instanceof \Illuminate\Http\UploadedFile) {
                    if ($variant->image && file_exists(public_path($variant->image))) {
                        unlink(public_path($variant->image));
                    }
                    $variantImage = time() . '-' . uniqid() . '.' . $variantData['image']->extension();
                    $variantData['image']->move(public_path('uploads/variants'), $variantImage);
                    $variant->image = 'uploads/variants/' . $variantImage;
                }

                $variant->save();
                $incomingVariantIds[] = $variant->id;

                // Update Options
                $existingOptionIds = $variant->options()->pluck('id')->toArray();
                $incomingOptionIds = [];

                if (!empty($variantData['options'])) {
                    foreach ($variantData['options'] as $optData) {
                        $option = !empty($optData['id'])
                            ? VariantOption::find($optData['id'])
                            : new VariantOption(['variant_id' => $variant->id]);

                        if (!$option) continue;

                        $option->fill([
                            'name'  => $optData['name'] ?? '',
                            'value' => $optData['value'] ?? '',
                        ])->save();

                        $incomingOptionIds[] = $option->id;
                    }
                }

                VariantOption::whereIn('id', array_diff($existingOptionIds, $incomingOptionIds))->delete();
            }
        }

        // Delete removed variants
        foreach (array_diff($existingVariantIds, $incomingVariantIds) as $rid) {
            $variant = ProductVariant::find($rid);
            if ($variant) {
                if ($variant->image && file_exists(public_path($variant->image))) {
                    unlink(public_path($variant->image));
                }
                $variant->options()->delete();
                $variant->delete();
            }
        }

        return redirect()->route('poducts.listing')->with('success', 'Product updated successfully!');
    }

    // List Products
    public function product_list()
    {
        $products = Product::with(['variants', 'category'])->paginate(10);
        return view('admin.vendor.index', compact('products'));
    }

    // Edit Product
    public function edit_product($id)
    {
        $product = Product::with(['variants.options', 'category'])->findOrFail($id);
        $categories = Category::all();
        return view('admin.vendor.edit', compact('product', 'categories'));
    }

    // Update Product


    public function delete_product($id)
    {
        $product = Product::with(['variants.options'])->findOrFail($id);

        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        if ($product->gallery_name) {
            $galleryImages = json_decode($product->gallery_name, true);
            if ($galleryImages && is_array($galleryImages)) {
                foreach ($galleryImages as $img) {
                    if ($img && file_exists(public_path($img))) {
                        unlink(public_path($img));
                    }
                }
            }
        }
        foreach ($product->variants as $variant) {
            if ($variant->image && file_exists(public_path($variant->image))) {
                unlink(public_path($variant->image));
            }
            foreach ($variant->options as $option) {
                $option->delete();
            }
            $variant->delete();
        }
        $product->delete();
        return redirect()->route('poducts.listing')->with('success', 'Product deleted successfully!');
    }



    public function show_cate()
    {
        return view('admin.vendor.add_category');
    }
    public function category_add(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255|unique:categories,name', 'slug' => 'nullable|string|max:255|unique:categories,slug', 'description' => 'nullable|string',]);

        $slug = $request->slug ?: Str::slug($request->name);
        Category::create(['name' => $request->name, 'slug' => $slug, 'description' => $request->description,]);
        return redirect()->route('category')->with('success', 'Category added successfully!');
    }
    public function category_list()
    {
        $cate_list = Category::paginate(10);
        return view('admin.vendor.category_list', compact('cate_list'));
    }
    public function category_edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.vendor.category_edit', compact('category'));
    }
    public function category_update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $request->validate(['name' => 'required|string|max:255|unique:categories,name,' . $id, 'slug' => 'nullable|string|max:255|unique:categories,slug,' . $id, 'description' => 'nullable|string',]);
        $category->update(['name' => $request->name, 'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->name), 'description' => $request->description,]);
        return redirect()->route('category.listing')->with('success', 'Category updated successfully!');
    }
    public function category_delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.listing')->with('success', 'Category deleted successfully!');
    }

    public function listUsers()
    {
        $userListing = User::all();
        return view('admin.vendor.user_listing', compact('userListing'));
    }


    public function listOrder()
    {
        $orderListing = Order::with(['user', 'items'])->get();
        return view('admin.vendor.order_listing', compact('orderListing'));
    }
    public function offer()
    {
        return view('admin.vendor.offer_cup');
    }
}