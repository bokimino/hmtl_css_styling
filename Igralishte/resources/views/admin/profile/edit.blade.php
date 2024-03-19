@extends('layouts.main')


@section('content')
<div class="container">
    <h2>Мој профил</h2>

    <a href="#" class="d-block p-3 link-dark text-decoration-none" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
        <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle" style="width: 40px" alt="Avatar" />
    </a>
    <form method="POST" action="{{ route('admin.profile.update') }}">
        @csrf
        <div class="form-group">
            <div class="image-preview-container">
                <img id="image-preview" src="{{ $admin->image }}" alt="Profile Image">
                <input type="file" class="form-control roundedInput" name="image" id="image" style="display: none;">
                <button id="change-image-btn" class="fancyOlive bg-white">Промени слика</button>
            </div>
        </div>
        <div class="form-group">
            <label for="name">Име</label>
            <input type="text" class="form-control roundedInput @error('name') is-invalid @enderror" name="name" id="name" value="{{ $admin->name }}">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email адреса</label>
            <input type="email" class="form-control roundedInput @error('email') is-invalid @enderror" name="email" id="email" value="{{ $admin->email }}">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone">Телефонски број</label>
            <input type="text" class="form-control roundedInput @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ $admin->phone }}">
            @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Лозинка</label>
            <input type="password" class="form-control roundedInput @error('password') is-invalid @enderror" name="password" id="password" placeholder="*********" disabled>
            <a class="fancyOlive" href="{{ route('admin.profile.editPassword') }}">Промени лозинка</a>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-lg-6 px-0 m-lg-auto">
            <button type="submit" class="btn btn-dark btn-block font-weight-bold roundedInput">Зачувај</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#change-image-btn').click(function() {
            $('#image').click();
        });
    });
</script>
@endsection