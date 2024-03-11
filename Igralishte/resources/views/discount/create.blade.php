<h1>Create New Discount</h1>

<form action="{{ route('discounts.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="code">Name of Discount:</label>
        <input type="text" name="code" id="code" class="form-control">
    </div>
    <div class="form-group">
        <label for="discount">Discount Percentage:</label>
        <input type="number" name="discount" id="discount" class="form-control">
    </div>
    <div class="form-group">
        <label for="category_id">Discount Category:</label>
        <select name="discount_category_id" id="category_id" class="form-control">
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="is_active">Status:</label>
        <select name="is_active" id="is_active" class="form-control">
            <option value="1">Active</option>
            <option value="0">Not Active</option>
        </select>
    </div>
    <div class="form-group">
        <label for="product_ids">Select Products:</label>
        <select name="product_ids[]" id="product_ids" class="form-control" multiple>
            @foreach ($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Create Discount</button>
</form>