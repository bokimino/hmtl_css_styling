<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Discount;
use App\Models\Brand_category;
use App\Models\Product_tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('query');

        $products = Product::query()
            ->where('name', 'like', '%' . $searchTerm . '%')
            ->orWhereHas('brand', function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%');
            })
            ->get();
    
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $productId = $request->input('product_id');

        $sizes = Size::all();
        $colors = Color::all();

        $productTags = $productId ? Product::find($productId)->tags : [];

        $brandCategories = Brand_category::all();
        $brands = Brand::all();
        $discounts = Discount::where('is_active', true)->get();


        return view('product.create', compact('sizes', 'colors', 'productTags', 'brandCategories', 'brands', 'discounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'sizes' => 'required_without_all:size1,size2,size3,size4,size5',


        ]);

        $product = new Product();


        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->is_active = $request->input('is_active', false);
        $product->size_description = $request->input('size_description');
        $product->maintenance = $request->input('maintenance');
        $product->quantity = $request->input('quantity');
        $product->brand_id = $request->input('brand_id');
        $product->discount_id = $request->input('discount_id');
        $product->brand_category_id = $request->input('brand_category_id');



        $product->save();

        $tagsInput = $request->input('tags', '');
        $tagsArray = explode(',', $tagsInput);

        foreach ($tagsArray as $tagName) {
            $tagName = trim($tagName);

            if (!empty($tagName)) {
                $tag = Product_tag::firstOrCreate(['name' => $tagName]);

                $product->tags()->attach($tag);
            }
        }
        $selectedSizes = $request->input('sizes', []);
        $product->sizes()->sync($selectedSizes);
        $selectedColors = $request->input('colors', []);
        $product->colors()->sync($selectedColors);


        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $sizes = Size::all();
        $colors = Color::all();
        $brandCategories = Brand_category::all();
        $brands = Brand::all();
        $discounts = Discount::where('is_active', true)->get();

        return view('product.edit', compact('product', 'sizes', 'colors', 'brandCategories', 'brands', 'discounts'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'is_active' => 'nullable|boolean',
            'size_description' => 'nullable|string',
            'maintenance' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'brand_id' => 'required|exists:brands,id',
            'discount_id' => 'nullable|exists:discounts,id',
            'tags' => 'nullable|string',
            'sizes' => 'nullable|array',
            'sizes.*' => 'exists:sizes,id',
            'colors' => 'nullable|array',
            'colors.*' => 'exists:colors,id',
        ]);

        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'is_active' => $request->input('is_active'),
            'size_description' => $request->input('size_description'),
            'maintenance' => $request->input('maintenance'),
            'quantity' => $request->input('quantity'),
            'brand_id' => $request->input('brand_id'),
            'discount_id' => $request->input('discount_id'),
            'brand_category_id' => $request->input('brand_category_id'),

        ]);
        $tagsInput = $request->input('tags', '');
        $tagsArray = explode(',', $tagsInput);
        $tagIds = [];
        foreach ($tagsArray as $tagName) {
            $tagName = trim($tagName);

            if (!empty($tagName)) {
                $tag = Product_tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
        }
        $product->tags()->sync($tagIds);

        $selectedSizes = $request->input('sizes', []);
        $product->sizes()->sync($selectedSizes);

        $selectedColors = $request->input('colors', []);
        $product->colors()->sync($selectedColors);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
    public function fetchBrandCategories($brandId)
    {
        $brand = Brand::findOrFail($brandId);
        $categories = $brand->categories;

        return response()->json($categories);
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('name', 'like', '%' . $query . '%')->get();

        return view('products.index', compact('products'));
    }
}
