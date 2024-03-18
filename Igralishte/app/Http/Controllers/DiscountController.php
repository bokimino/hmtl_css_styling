<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Discount;
use Illuminate\Http\Request;
use App\Models\Discount_category;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('query');

        $activeDiscounts = Discount::where('is_active', true)
            ->where(function ($query) use ($searchTerm) {
                $query->where('code', 'like', '%' . $searchTerm . '%')
                    ->orWhere('discount', 'like', '%' . $searchTerm . '%');
            })
            ->get();

        $inactiveDiscounts = Discount::where('is_active', false)
            ->where(function ($query) use ($searchTerm) {
                $query->where('code', 'like', '%' . $searchTerm . '%')
                    ->orWhere('discount', 'like', '%' . $searchTerm . '%');
            })
            ->get();

        $discounts = Discount::all();

        return view('discount.index', compact('discounts', 'activeDiscounts', 'inactiveDiscounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Discount_category::all();
        $products = Product::all();
        return view('discount.create', compact('categories', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255',
            'discount' => 'required|numeric',
            'is_active' => 'boolean',
            'discount_category_id' => 'required|exists:discount_categories,id',
            'product_ids' => 'nullable|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        $discount = new Discount();
        $discount->code = $request->input('code');
        $discount->discount = $request->input('discount');
        $discount->discount_category_id = $request->input('discount_category_id');
        $discount->is_active = $request->input('is_active');
        $discount->save();

        $productIds = $request->input('product_ids', []);
        foreach ($productIds as $productId) {
            $product = Product::find($productId);
            if ($product) {
                $product->discount_id = $discount->id;
                $product->save();
            }
        }

        return redirect()->route('discounts.index')->with('success', 'Discount created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discount $discount)
    {
        $categories = Discount_category::all();
        $products = Product::all();

        return view('discount.edit', compact('discount', 'categories', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discount $discount)
    {
        $request->validate([
            'code' => 'required|string|max:255',
            'discount' => 'required|numeric',
            'is_active' => 'boolean',
            'discount_category_id' => 'required|exists:discount_categories,id',
            'product_ids' => 'nullable|array',
            'product_ids.*' => 'exists:products,id',
        ]);
        $oldIsActive = $discount->is_active;

        $discount->update([
            'code' => $request->input('code'),
            'discount' => $request->input('discount'),
            'discount_category_id' => $request->input('discount_category_id'),
            'is_active' => $request->input('is_active'),
        ]);
        if ($oldIsActive && !$discount->is_active) {
            foreach ($discount->products as $product) {
                $product->discount_id = null;
                $product->save();
            }
        }
        $productIds = $request->input('product_ids', []);

        $previousProductIds = $discount->products->pluck('id')->toArray();

        $productsToRemove = array_diff($previousProductIds, $productIds);

        Product::whereIn('id', $productsToRemove)->update(['discount_id' => null]);

        Product::whereIn('id', $productIds)->update(['discount_id' => $discount->id]);


        return redirect()->route('discounts.index')->with('success', 'Discount updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();

        return redirect()->route('discounts.index')->with('success', 'Discount deleted successfully.');
    }
}
