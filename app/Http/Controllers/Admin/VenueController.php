<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use App\Models\VenueImage;
use App\Models\VenueReview;
use App\Models\VenueSpace;
use App\Models\VenueCuisine;
use App\Models\CateringPackage;
use App\Models\DecorationTheme;
use App\Models\AdditionalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VenueController extends Controller
{
    public function index()
    {
       echo 'kjikejhkjdhjfgdifed';
    }

    public function create()
    {
        return view('admin.venue.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:50',
            'rating' => 'nullable|numeric|between:0,5',
            'total_reviews' => 'nullable|integer',
            'guest_capacity_min' => 'nullable|integer',
            'guest_capacity_max' => 'nullable|integer',
            'starting_price' => 'nullable|numeric',
            'event_spaces_count' => 'nullable|integer',
            'available_this_weekend' => 'nullable|boolean',
            'main_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'type' => 'nullable|string',
            'amenities' => 'nullable|string',
            'video' => 'nullable|string',
            'featured' => 'nullable|boolean',
            'descr'=>'nullable',

            // Images
            'images.*.image_path' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'images.*.description' => 'nullable|string|max:500',

            // Spaces
            'spaces.*.name' => 'nullable|string|max:255',
            'spaces.*.description' => 'nullable|string',
            'spaces.*.capacity_min' => 'nullable|integer',
            'spaces.*.capacity_max' => 'nullable|integer',
            'spaces.*.size_sqft' => 'nullable|integer',
            'spaces.*.ac_available' => 'nullable|boolean',
            'spaces.*.open_air' => 'nullable|boolean',
            'spaces.*.price_per_day' => 'nullable|numeric',
            'spaces.*.features' => 'nullable|string',

            // Cuisines
            'cuisines.*.cuisine_name' => 'nullable|string|max:100',
            'catering.*.package_name' => 'nullable|string|max:100',

            // Catering
            'catering.*.price_per_plate' => 'nullable|numeric',
            'catering.*.menu_details' => 'nullable|string',

            // Themes
            'themes.*.theme_name' => 'nullable|string|max:100',

            // Services
            'services.*.service_name' => 'nullable|string|max:100',
            'services.*.available' => 'nullable|boolean',

            // Reviews
            'reviews.*.reviewer_name' => 'nullable|string|max:100',
            'reviews.*.rating' => 'nullable|numeric|between:0,5',
            'reviews.*.review_text' => 'nullable|string',
            'reviews.*.review_date' => 'nullable|date',
        ]);

        DB::beginTransaction();
        try {
            // 1. Save Venue
            $venue = Venue::create([
                'name' => $request->name,
                'location' => $request->location,
                'city' => $request->city,
                'state' => $request->state,
                'phone' => $request->phone,
                'rating' => $request->rating,
                'total_reviews' => $request->total_reviews ?? 0,
                'guest_capacity_min' => $request->guest_capacity_min,
                'guest_capacity_max' => $request->guest_capacity_max,
                'starting_price' => $request->starting_price,
                'event_spaces_count' => $request->event_spaces_count,
                'available_this_weekend' => $request->available_this_weekend ?? 0,
                'type' => $request->type,
                'amenities' => $request->amenities, // ✅ Fixed typo here
                'video' => $request->video,
                'featured' => $request->featured ?? 0,
                'descr'=>$request->descr,
            ]);

            // 2. Save Main Image
            if ($request->hasFile('main_image')) {
                $filename = time() . '_' . $request->file('main_image')->getClientOriginalName();
                $request->file('main_image')->move(public_path('venue_images'), $filename);
                $venue->main_image = 'venue_images/' . $filename;
                $venue->save();
            }

            // 3. Save Multiple Venue Images
            if ($request->has('images')) {
                foreach ($request->images as $imageData) {
                    $path = null;

                    if (isset($imageData['image_path']) && $imageData['image_path'] instanceof \Illuminate\Http\UploadedFile) {
                        $filename = time() . '_' . $imageData['image_path']->getClientOriginalName();
                        $imageData['image_path']->move(public_path('venue_images'), $filename);
                        $path = 'venue_images/' . $filename;
                    }

                    VenueImage::create([
                        'venue_id' => $venue->id,
                        'image_path' => $path,
                        'description' => $imageData['description'] ?? null,
                    ]);
                }
            }

            // 4. Save Event Spaces
            if ($request->filled('spaces')) {
                foreach ($request->spaces as $space) {
                    VenueSpace::create([
                        'venue_id' => $venue->id,
                        'name' => $space['name'] ?? null,
                        'description' => $space['description'] ?? null,
                        'capacity_min' => $space['capacity_min'] ?? null,
                        'capacity_max' => $space['capacity_max'] ?? null,
                        'size_sqft' => $space['size_sqft'] ?? null,
                        'ac_available' => $space['ac_available'] ?? 0,
                        'open_air' => $space['open_air'] ?? 0,
                        'features' => $space['features'] ?? null,
                        'price_per_day' => $space['price_per_day'] ?? null,
                    ]);
                }
            }

            // 5. Save Cuisines
            if ($request->filled('cuisines')) {
                foreach ($request->cuisines as $cuisine) {
                    VenueCuisine::create([
                        'venue_id' => $venue->id,
                        'cuisine_name' => $cuisine['cuisine_name'] ?? null,
                    ]);
                }
            }

            // 6. Save Catering Packages
            if ($request->filled('catering')) {
                foreach ($request->catering as $package) {
                    CateringPackage::create([
                        'venue_id' => $venue->id,
                        'package_name' => $package['package_name'] ?? null,
                        'price_per_plate' => $package['price_per_plate'] ?? null,
                        'menu_details' => $package['menu_details'] ?? null,
                    ]);
                }
            }

            // 7. Save Themes
            if ($request->filled('themes')) {
                foreach ($request->themes as $theme) {
                    DecorationTheme::create([
                        'venue_id' => $venue->id,
                        'theme_name' => $theme['theme_name'] ?? null,
                    ]);
                }
            }

            // 8. Save Services
            if ($request->filled('services')) {
                foreach ($request->services as $service) {
                    AdditionalService::create([
                        'venue_id' => $venue->id,
                        'service_name' => $service['service_name'] ?? null,
                        'available' => $service['available'] ?? 0,
                    ]);
                }
            }

            // 9. Save Reviews
            if ($request->filled('reviews')) {
                foreach ($request->reviews as $review) {
                    VenueReview::create([
                        'venue_id' => $venue->id,
                        'reviewer_name' => $review['reviewer_name'] ?? null,
                        'rating' => $review['rating'] ?? null,
                        'review_text' => $review['review_text'] ?? null,
                        'review_date' => $review['review_date'] ?? now(),
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.venue.index')->with('success', 'Venue created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Venue creation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create venue. Check logs for details.');
        }
    }



    public function edit($id)
    {
        // Load venue with all its related data

        $venue = Venue::with([
            'images',
            'spaces',
            'cuisines',
            'cateringPackages',
            'decorationThemes',
            'additionalServices',   // ✅ changed from "additionalServices" to "services"
            'reviews'
        ])->findOrFail($id);



        // Return the edit view with venue data
        return view('admin.venue.edit', compact('venue'));
    }

    public function update(Request $request, $id)
    {
        // echo "<pre>";

        $venue = Venue::findOrFail($id);
        //  print_r($venue); exit;
        $validated = $request->validate([
            // Venue
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:50',
            'rating' => 'nullable|numeric|between:0,5',
            'total_reviews' => 'nullable|integer',
            'guest_capacity_min' => 'nullable|integer',
            'guest_capacity_max' => 'nullable|integer',
            'starting_price' => 'nullable|numeric',
            'event_spaces_count' => 'nullable|integer',
            'available_this_weekend' => 'nullable',
            'main_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'type'=>'nullable|string',
            'amenities'=>'nullable|string',
            'video'=>'nullable|string',
            'featured'=>'nullable|boolean',
            'descr'=>'nullable',

            // Spaces
            'spaces.*.name' => 'nullable|string|max:255',
            'spaces.*.capacity_min' => 'nullable|integer',
            'spaces.*.capacity_max' => 'nullable|integer',
            'spaces.*.size_sqft' => 'nullable|integer',
            'spaces.*.ac_available' => 'nullable',
            'spaces.*.open_air' => 'nullable',
            'spaces.*.price_per_day' => 'nullable|numeric',
            'spaces.*.features' => 'nullable|string',

            // Cuisines
            'cuisines.*.cuisine_name' => 'nullable|string|max:100',

            // Catering
            'catering.*.package_name' => 'nullable|string|max:100',
            'catering.*.price_per_plate' => 'nullable|numeric',
            'catering.*.menu_details' => 'nullable|string',

            // Themes
            'themes.*.theme_name' => 'nullable|string|max:100',

            // Services
            'services.*.service_name' => 'nullable|string|max:100',
            'services.*.available' => 'nullable',

            // Reviews
            'reviews.*.reviewer_name' => 'nullable|string|max:100',
            'reviews.*.rating' => 'nullable|numeric|between:0,5',
            'reviews.*.review_text' => 'nullable|string',
            'reviews.*.review_date' => 'nullable|date',

            // Images
            'images.*.file' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'images.*.description' => 'nullable|string|max:255',
        ]);

            // 1. Update Venue
            $venue->update($validated);

            // 2. Update/Upload Images
            if ($request->hasFile('main_image')) {
                if ($venue->main_image && file_exists(public_path($venue->main_image))) {
                    unlink(public_path($venue->main_image));
                }

                $filename = time() . '_' . $request->file('main_image')->getClientOriginalName();
                $request->file('main_image')->move(public_path('venue_images'), $filename);
                $venue->main_image = 'venue_images/' . $filename;
            }

            $venue->save();

            // ✅ Handle deleting selected images
            if ($request->has('delete_images')) {
                foreach ($request->delete_images as $imageId) {
                    $image = VenueImage::find($imageId);
                    if ($image) {
                        // Delete file if exists
                        if ($image->image_path && file_exists(public_path($image->image_path))) {
                            unlink(public_path($image->image_path));
                        }
                        $image->delete();
                    }
                }
            }

            // ✅ Handle uploading/updating venue images
            if ($request->has('images')) {
                foreach ($request->images as $i => $imageData) {

                    // If new image uploaded
                    if (isset($imageData['image_path']) && $imageData['image_path'] instanceof \Illuminate\Http\UploadedFile) {
                        $filename = time() . '_' . $imageData['image_path']->getClientOriginalName();
                        $imageData['image_path']->move(public_path('venue_images'), $filename);
                        $path = 'venue_images/' . $filename;
                    }
                    // If existing image is already saved, keep old path
                    elseif (isset($venue->images[$i])) {
                        $path = $venue->images[$i]->image_path;
                    }
                    // If nothing uploaded and no existing image → skip this loop
                    else {
                        continue;
                    }

                    // ✅ Now safely update or create venue image
                    VenueImage::updateOrCreate(
                        ['id' => $venue->images[$i]->id ?? null],
                        [
                            'venue_id'    => $venue->id,
                            'image_path'  => $path,
                            'description' => $imageData['description'] ?? null,
                        ]
                    );
                }
            }

        // 3. Relations (delete + reinsert with venue_id)
        $venue->spaces()->delete();
        if ($request->filled('spaces')) {
            foreach ($request->spaces as $space) {
                $venue->spaces()->create(array_merge($space, ['venue_id' => $venue->id]));
            }
        }

        $venue->cuisines()->delete();
        if ($request->filled('cuisines')) {
            foreach ($request->cuisines as $cuisine) {
                $venue->cuisines()->create(array_merge($cuisine, ['venue_id' => $venue->id]));
            }
        }

        $venue->cateringPackages()->delete();
        if ($request->filled('catering')) {
            foreach ($request->catering as $package) {
                $venue->cateringPackages()->create(array_merge($package, ['venue_id' => $venue->id]));
            }
        }




        $venue->decorationThemes()->delete();
        if ($request->filled('themes')) {
            foreach ($request->themes as $theme) {
                $venue->decorationThemes()->create(array_merge($theme, ['venue_id' => $venue->id]));
            }
        }

        $venue->additionalServices()->delete();
        if ($request->filled('services')) {
            foreach ($request->services as $service) {
                $venue->additionalServices()->create(array_merge($service, ['venue_id' => $venue->id]));
            }
        }

        $venue->reviews()->delete();
        if ($request->filled('reviews')) {
            foreach ($request->reviews as $review) {
                $venue->reviews()->create(array_merge($review, ['venue_id' => $venue->id]));
            }
        }

         return redirect()->route('admin.venue.index')->with('success', 'Venue and related details updated successfully!');
    }


    public function delete($id)
    {
        // Find venue by ID or throw a 404 if not found
        $venue = Venue::findOrFail($id);
        return redirect()->route('admin.venue.index')->with('success', 'Venue and related details deleted successfully!');

    }
}
