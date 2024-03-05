<h1>Edit Discount</h1>

<form action="{{ route('discounts.update', $discount->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="code">Code:</label>
    <input type="text" name="code" id="code" value="{{ $discount->code }}" required>

    <label for="discount">Discount:</label>
    <input type="text" name="discount" id="discount" value="{{ $discount->discount }}" required>

    <label for="is_active">Active:</label>
    <input type="checkbox" name="is_active" id="is_active" {{ $discount->is_active ? 'checked' : '' }}>

    <select name="category_id" id="category_id" required>
        <option value="">Select Category</option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}" {{ $category->id == $discount->category_id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
        @endforeach
    </select>

    <label for="product_ids">Apply discount to product(s):</label>
    <input type="text" name="product_ids" id="product_ids" placeholder="Product ID(s)">


    <button type="submit">Update Discount</button>


</form>