<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Brand_category;
use App\Models\Brand_tag;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Brand_tag::pluck('name')->toArray();
        $activeBrands = Brand::where('is_active', true)->get();
        $archivedBrands = Brand::where('is_active', false)->get();
        return view('brand.index', compact('activeBrands', 'archivedBrands', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $brandId = $request->input('brand_id');
        $tags = Brand_tag::all();
        $categories = Brand_category::all();
        $brandTags = $brandId ? Brand::find($brandId)->tags : [];

        return view('brand.create', compact('categories', 'tags', 'brandTags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([]);

        $brand = new Brand();
        $brand->name = $request->input('name');
        $brand->description = $request->input('description');
        $brand->is_active = $request->input('is_active');

        $brand->save();

        // Attach selected categories to the brand
        $brand->categories()->attach($request->input('brand_category_id'));

        $tagsInput = $request->input('tags', '');
        $tagsArray = explode(',', $tagsInput);

        foreach ($tagsArray as $tagName) {
            $tagName = trim($tagName);
    
            if (!empty($tagName)) {
                $tag = Brand_tag::firstOrCreate(['name' => $tagName]);
                $brand->tags()->attach($tag);
            }
        }
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('brand_images');
                $brand->images()->create(['image_path' => $imagePath]);
            }
        }

        return redirect()->route('brands.index')->with('success', 'Brand created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        $categories = Brand_category::all();
        $tags = Brand_tag::all();
        $images = $brand->images;

        return view('brand.edit', compact('brand', 'categories', 'tags', 'images'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'brand_category_ids' => 'nullable|array',
            'brand_category_ids.*' => 'exists:brand_categories,id',
            'brand_tag_ids' => 'nullable|array',
            'brand_tag_ids.*' => 'exists:brand_tags,id',
            'images' => 'nullable|array',
            'images.*' => 'image',
            'remove_images' => 'nullable|array',
            'remove_images.*' => 'exists:brand_images,id',
            'is_active' => 'boolean',
        ]);

        $brand->name = $request->input('name');
        $brand->description = $request->input('description');
        $brand->is_active = $request->input('is_active', false);

        $brandCategoryIds = $request->input('brand_category_ids') ?? [];
        $brand->categories()->sync($brandCategoryIds);

        $brandTagIds = $request->input('brand_tag_ids') ?? [];
        $brand->tags()->sync($brandTagIds);
        // Handle removal of existing images
        $removeImageIds = $request->input('remove_images', []);
        foreach ($removeImageIds as $imageId) {
            $brand->images()->where('id', $imageId)->delete();
        }

        // Handle addition of new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('brand_images');
                $brand->images()->create(['image_path' => $imagePath]);
            }
        }

        $brand->save();

        return redirect()->route('brands.index')->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->images()->delete();
        $brand->tags()->detach();

        $brand->delete();

        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully.');
    }
}
