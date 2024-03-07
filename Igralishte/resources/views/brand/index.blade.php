<h1>Active Brands</h1>

<a href="{{ route('brands.create') }}" class="btn btn-primary">Create New Brand</a>

<!-- Active Brands -->
<h2>Active Brands</h2>
@foreach($activeBrands as $brand)
    <div>
        <span>{{ $brand->name }}</span>
        <a href="{{ route('brands.edit', $brand->id) }}">Edit</a>
        <form action="{{ route('brands.destroy', $brand->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>
@endforeach

<!-- Archived Brands -->
<h2>Archived Brands</h2>
@foreach($archivedBrands as $brand)
    <div>
        <span>{{ $brand->name }}</span>
        <a href="{{ route('brands.edit', $brand->id) }}">Edit</a>
        <form action="{{ route('brands.destroy', $brand->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>
@endforeach