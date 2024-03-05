<h1>Create New Discount</h1>

<form action="{{ route('discounts.store') }}" method="POST">
    @csrf

    <label for="code">Code:</label>
    <input type="text" name="code" id="code" required>

    <label for="discount">Discount:</label>
    <input type="number" name="discount" id="discount" required>

    <label for="is_active">Active:</label>
    <input type="checkbox" name="is_active" id="is_active" checked>

    <label for="category_id">Category:</label>
    <select name="category_id" id="category_id" required>
        <option value="">Select Category</option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <label for="product_ids">Apply discount to product(s):</label>
    <input type="text" name="product_ids" id="product_ids" placeholder="Product ID(s)">



    <button type="submit">Create Discount</button>
</form>