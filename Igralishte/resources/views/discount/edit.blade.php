<h1>Edit Discount</h1>

<form action="{{ route('discounts.update', $discount) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="code">Name of Discount:</label>
        <input type="text" name="code" id="code" class="form-control" value="{{ $discount->code }}">
    </div>
    <div class="form-group">
        <label for="discount">Discount Percentage:</label>
        <input type="number" name="discount" id="discount" class="form-control" value="{{ $discount->discount }}">
    </div>
    <div class="form-group">
        <label for="category">Discount Category:</label>
        <select name="discount_category_id" id="category" class="form-control">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $discount->discount_category_id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="status">Status:</label>
        <select name="is_active" id="status" class="form-control">
            <option value="1" {{ $discount->is_active ? 'selected' : '' }}>Active</option>
            <option value="0" {{ !$discount->is_active ? 'selected' : '' }}>Not Active</option>
        </select>
    </div>
    <div class="form-group">
        <label for="product_ids">Select Products:</label>
        <select name="product_ids[]" id="product_ids" class="form-control" multiple>
            @foreach ($products as $product)
                <option value="{{ $product->id }}" {{ $discount->products->contains($product) ? 'selected' : '' }}>
                    {{ $product->name }}
                </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update Discount</button>
</form>