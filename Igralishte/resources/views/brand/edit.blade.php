<h1>Edit Brand</h1>

<div class="container">
    <h1>Edit Brand</h1>
    <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Brand Name -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $brand->name }}" class="form-control" required>
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control">{{ $brand->description }}</textarea>
        </div>

        <!-- Brand Category -->
        <div class="form-group">
            <label for="brand_category_id">Category:</label>
            <select name="brand_category_id" id="brand_category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $brand->brand_category_id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Brand Tags -->
        <div class="form-group">
            <label for="brand_tag_ids">Tags:</label>
            <select name="brand_tag_ids[]" id="brand_tag_ids" class="form-control" multiple>
                @foreach ($tags as $tag)
                <option value="{{ $tag->id }}" {{ in_array($tag->id, $brand->tags->pluck('id')->toArray()) ? 'selected' : '' }}>
                    {{ $tag->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Images -->
        <div class="form-group">
            <label for="image1">Image 1:</label>
            <input type="file" name="images[]" id="image1" accept="image/*" multiple>

            <label for="image2">Image 2:</label>
            <input type="file" name="images[]" id="image2" accept="image/*" multiple>

            <label for="image3">Image 3:</label>
            <input type="file" name="images[]" id="image3" accept="image/*" multiple>

            <label for="image4">Image 4:</label>
            <input type="file" name="images[]" id="image4" accept="image/*" multiple>
        </div>

        <!-- Is Active -->
        <div class="form-group">
        <label>Status:</label><br>
        <select name="is_active" class="form-control">
            <option value="1" {{ $brand->is_active ? 'selected' : '' }}>Active</option>
            <option value="0" {{ !$brand->is_active ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

        <button type="submit" class="btn btn-primary">Update Brand</button>
    </form>
</div>