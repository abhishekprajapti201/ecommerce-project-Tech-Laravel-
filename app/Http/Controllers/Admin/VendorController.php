<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\VendorService;
use App\Models\VendorReview;
use App\Models\VendorPortfolio;

class VendorController extends Controller
{
    public function index()
    {
        // Eager load services count, reviews count etc. if needed
        $vendors = Vendor::withCount(['services', 'portfolios', 'reviews'])
            ->orderBy('created_at', 'desc')
            ->get(); // pagination

        return view('admin.vendor.index', compact('vendors'));
    }
        
    public function create()
    {
        return view('admin.vendor.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Vendor table fields
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:vendors,slug',
            'tagline' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'years_experience' => 'nullable|integer|min:0',
            'starting_price' => 'nullable|integer|min:0',
            'rating_avg' => 'nullable|numeric|min:0|max:5',
            'total_clients' => 'nullable|integer|min:0',
            'base_city' => 'nullable|string|max:255',
            'base_state' => 'nullable|string|max:255',
            'service_area' => 'nullable|string|max:255',
            'is_available_all_week' => 'nullable|boolean',

            'type' => 'nullable|string|max:100',
            'cover_image' => 'nullable|url|max:255',
            'address' => 'nullable|string',
            'verified' => 'nullable|boolean',
            'status' => 'nullable|in:active,inactive,pending',

            // Services
            'services' => 'nullable|array',
            'services.*.name' => 'required_with:services|string|max:255',

            // Portfolio
            'portfolio' => 'nullable|array',
            'portfolio.*.title' => 'required_with:portfolio|string|max:255',
            'portfolio.*.image' => 'nullable|string|max:255',

            // Reviews
            'reviews' => 'nullable|array',
            'reviews.*.client_name' => 'required_with:reviews|string|max:255',
            'reviews.*.rating' => 'nullable|numeric|min:0|max:5',
            'reviews.*.review_text' => 'nullable|string',
        ]);

        // Save vendor
        $vendor = Vendor::create($validated);

        // Save services
        if (!empty($validated['services'])) {
            foreach ($validated['services'] as $srv) {
                VendorService::create([
                    'vendor_id' => $vendor->id,
                    'service_name' => $srv['name']
                ]);
            }
        }

        // Save portfolio
        if (!empty($validated['portfolio'])) {
            foreach ($validated['portfolio'] as $item) {
                VendorPortfolio::create([
                    'vendor_id' => $vendor->id,
                    'title' => $item['title'],
                    'image' => $item['image'] ?? null
                ]);
            }
        }

        // Save reviews
        if (!empty($validated['reviews'])) {
            foreach ($validated['reviews'] as $rev) {
                VendorReview::create([
                    'vendor_id' => $vendor->id,
                    'client_name' => $rev['client_name'],
                    'rating' => $rev['rating'] ?? null,
                    'review_text' => $rev['review_text'] ?? null
                ]);
            }
        }

        return redirect()->route('vendor.create')->with('success', 'Vendor created successfully!');
    }

     public function edit($id)
    {
        $vendor = Vendor::with(['services', 'portfolios', 'reviews'])->findOrFail($id);

        return view('admin.vendor.edit', compact('vendor'));
    }

    /**
     * Update vendor details
     */
    public function update(Request $request, $id)
    {
        // echo "<pre>"; 
        // // print_r($_POST); print_r($_FILES); 
        //  foreach ($request->portfolio as $i => $item) {
        //     // print_r($item);
        //     if ($request->hasFile("portfolio.$i.image")) {
        //         $file = $request->file("portfolio.$i.image");
        //         $filename = time() . '_' . $file->getClientOriginalName();
        //         // $file->move(public_path('vendor/portfolio'), $filename);
        //         echo $imagePath = 'vendor/portfolio/' . $filename;
        //     }
        //  }
        // exit;
        $vendor = Vendor::findOrFail($id);

        // ✅ Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:vendors,slug,' . $vendor->id,
            'tagline' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'years_experience' => 'nullable|integer|min:0',
            'starting_price' => 'nullable|integer|min:0',
            'rating_avg' => 'nullable|numeric|min:0|max:5',
            'total_clients' => 'nullable|integer|min:0',
            'base_city' => 'nullable|string|max:255',
            'base_state' => 'nullable|string|max:255',
            'service_area' => 'nullable|string|max:255',
            'is_available_all_week' => 'nullable|boolean',
            'type' => 'nullable|string|max:100',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
            'delete_cover_image' => 'nullable|boolean',
            'address' => 'nullable|string',
            'verified' => 'nullable|boolean',
            'status' => 'required|in:active,inactive,pending',
        ]);

        // ✅ Delete cover image if checked
        if ($request->filled('delete_cover_image') && $request->delete_cover_image) {
            if ($vendor->cover_image && file_exists(public_path($vendor->cover_image))) {
                unlink(public_path($vendor->cover_image));
            }
            $validated['cover_image'] = null;
        }

        // ✅ Upload new cover image
        if ($request->hasFile('cover_image')) {
            if ($vendor->cover_image && file_exists(public_path($vendor->cover_image))) {
                unlink(public_path($vendor->cover_image));
            }
            $file = $request->file('cover_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('vendor/cover'), $filename);
            $validated['cover_image'] = 'vendor/cover/' . $filename;
        }

        // ✅ Update vendor
        $vendor->update($validated);

        // ✅ Sync services
        $vendor->services()->delete();
        if ($request->has('services')) {
            foreach ($request->services as $service) {
                if (!empty($service['name'])) {
                    $vendor->services()->create([
                        'service_name' => $service['name'],
                    ]);
                }
            }
        }

        // ✅ Sync portfolio
        if ($request->has('portfolio')) {
            foreach ($request->portfolio as $i => $item) {
                // Delete portfolio image if checkbox checked
                if (isset($item['delete']) && $item['delete']) {
                    if (!empty($item['existing_image']) && file_exists(public_path($item['existing_image']))) {
                        unlink(public_path($item['existing_image']));
                    }
                    if (!empty($item['id'])) {
                        $vendor->portfolios()->where('id', $item['id'])->delete();
                    }
                    continue;
                }

                $imagePath = $item['existing_image'] ?? null;



                // Upload new portfolio image
                if ($request->hasFile("portfolio.$i.image")) {
                    $file = $request->file("portfolio.$i.image");
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('vendor/portfolio'), $filename);
                    $imagePath = 'vendor/portfolio/' . $filename;
                }

                

                // Create or update portfolio entry
                if (!empty($item['title']) || $imagePath) {
                    // dd($imagePath);
                    if (!empty($item['id'])) {
                        $vendor->portfolios()->where('id', $item['id'])->update([
                            'title' => $item['title'] ?? '',
                            'image_url' => $imagePath,
                        ]);
                    } else {
                        // dd($imagePath);
                        $vendor->portfolios()->create([
                            'title' => $item['title'] ?? '',
                            'image_url' => $imagePath,
                        ]);
                    }
                }
            }
        }

        // ✅ Sync reviews
        $vendor->reviews()->delete();
        if ($request->has('reviews')) {
            foreach ($request->reviews as $review) {
                if (!empty($review['client_name'])) {
                    $vendor->reviews()->create([
                        'reviewer_name' => $review['client_name'],
                        'rating' => $review['rating'] ?? 0,
                        'comment' => $review['review_text'] ?? '',
                        'reviewed_on' => now(),
                    ]);
                }
            }
        }

        return redirect()->route('admin.vendors.index')->with('success', 'Vendor updated successfully!');
    }

}