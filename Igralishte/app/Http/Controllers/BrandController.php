<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Brand_tag;
use Illuminate\Http\Request;
use App\Models\Brand_category;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('query');

        $activeBrands = Brand::where('is_active', true)
            ->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('categories', function ($subquery) use ($searchTerm) {
                        $subquery->where('name', 'like', '%' . $searchTerm . '%');
                    });
            })
            ->get();

        $archivedBrands = Brand::where('is_active', false)
            ->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('categories', function ($subquery) use ($searchTerm) {
                        $subquery->where('name', 'like', '%' . $searchTerm . '%');
                    });
            })
            ->get();

        $tags = Brand_tag::pluck('name')->toArray();

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
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'is_active' => 'required|boolean',
            'images' => 'required|array|min:1',
            'images.*' => 'image',
        ]);

        $brand = new Brand();
        $brand->name = $request->input('name');
        $brand->description = $request->input('description');
        $brand->is_active = $request->input('is_active');

        $brand->save();

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
                $imagePath = $image->store('brand_images', 'public');
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
            'description' => 'required|string',
            'is_active' => 'required|boolean',
            'images' => 'required|array|min:1',
            'images.*' => 'image',
        ]);

        $brand->name = $request->input('name');
        $brand->description = $request->input('description');
        $brand->is_active = $request->input('is_active', false);

        $brandCategoryIds = $request->input('brand_category_ids') ?? [];
        $brand->categories()->sync($brandCategoryIds);

        $brandTagIds = $request->input('brand_tag_ids') ?? [];
        $brand->tags()->sync($brandTagIds);

        $removeImageIds = $request->input('remove_images', []);
        foreach ($removeImageIds as $imageId) {
            $brand->images()->where('id', $imageId)->delete();
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                if ($index < 4) {

                    $imagePath = $image->store('brand_images', 'public');

                    if ($index < count($brand->images)) {

                        $brand->images()->where('id', $request->input('image_ids.' . $index))->update(['image_path' => $imagePath]);
                    } else {

                        $brand->images()->create(['image_path' => $imagePath]);
                    }
                }
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
        Product::where('brand_id', $brand->id)->update(['brand_id' => null]);

        $brand->images()->delete();
        $brand->tags()->detach();

        $brand->delete();

        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully.');
    }
}
