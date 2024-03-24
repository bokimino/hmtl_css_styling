@extends('layouts.main')


@section('content')
<div class="inter-500">
    <div class="container">
        <h2>Мој профил</h2>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="py-3" title="">
            <img src="{{ asset('storage/' . $admin->image) }}" class="rounded-circle" style="width: 120px; height: 120px;" alt="Avatar" />
        </div>
        <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <a class="fancyOlive border-0 bg-white" id="changeImage" type="button">Промени слика</a>
                <input type="file" class="form-control-file" name="image" id="image" style="display: none;">
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
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#changeImage').click(function() {
            $('#image').click();
        });
    });
</script>
@endsection