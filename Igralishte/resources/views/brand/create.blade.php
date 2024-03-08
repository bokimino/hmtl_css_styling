<div class="container">
    <h1>Create New Brand</h1>
    <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="brand_category_id">Category:</label>
            <select name="brand_category_id" id="brand_category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="brand_tag_ids">Tags:</label>
            <select name="brand_tag_ids[]" id="brand_tag_ids" class="form-control" multiple>
                <option value="">Select Tag</option>
                @foreach($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>

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

        <div class="form-group">
            <label>Status:</label><br>
            <label class="radio-inline">
                <input type="radio" name="is_active" value="1"> Active
            </label>
            <label class="radio-inline">
                <input type="radio" name="is_active" value="0"> Inactive
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Create Brand</button>
    </form>
</div>