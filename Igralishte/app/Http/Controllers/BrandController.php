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
        $activeBrands = Brand::where('is_active', true)->get();
        $archivedBrands = Brand::where('is_active', false)->get();
        return view('brand.index', compact('activeBrands', 'archivedBrands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Brand_tag::all();
        $categories = Brand_category::all();
        return view('brand.create', compact('categories', 'tags'));
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
        $brand->brand_category_id = $request->input('brand_category_id');
        $brand->is_active = $request->has('is_active');

        $brand->save();

        $brandTagIds = $request->input('brand_tag_ids');
        if ($brandTagIds) {
            $brand->tags()->attach($brandTagIds);
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
            'brand_category_id' => 'required|exists:brand_categories,id',
            'brand_tag_ids' => 'nullable|array',
            'brand_tag_ids.*' => 'exists:brand_tags,id',
            'images' => 'nullable|array',
            'images.*' => 'image',
            'is_active' => 'boolean',
        ]);

        $brand->name = $request->input('name');
        $brand->description = $request->input('description');
        $brand->brand_category_id = $request->input('brand_category_id');
        $brand->is_active = $request->has('is_active');

        $brandTagIds = $request->input('brand_tag_ids') ?? [];
        $brand->tags()->sync($brandTagIds);
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
