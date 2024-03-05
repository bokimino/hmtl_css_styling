<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Discount_category;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discounts = Discount::all();
        return view('discount.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Discount_category::all();

        return view('discount.create', compact('categories'));
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
            'category_id' => 'required|exists:discount_categories,id',


        ]);

        $discount = new Discount();
        $discount->code = $request->input('code');
        $discount->discount = $request->input('discount');
        $discount->is_active = $request->has('is_active');
        $discount->discount_category_id = $request->input('category_id');

        $discount->save();

        $productIds = explode(',', $request->input('product_ids'));
        $discount->products()->attach($productIds);

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


        return view('discount.edit', compact('discount', 'categories'));
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
            'category_id' => 'required|exists:discount_categories,id',
        ]);

        $discount->code = $request->input('code');
        $discount->discount = $request->input('discount');
        $discount->is_active = $request->has('is_active');
        $discount->discount_category_id = $request->input('category_id');


        $discount->save();

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
