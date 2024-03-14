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
        $display = $request->query('display', 'list');

        $products = Product::all();

        return view('product.index', compact('products', 'display'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $productId = $request->input('product_id');

        $sizes = Size::all();
        $colors = Color::all();

        // Fetch product tags if product ID is available
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
    public function getBrandCategories(Brand $brand)
    {
        return $brand->categories()->select('id', 'name')->get();
    }
}
