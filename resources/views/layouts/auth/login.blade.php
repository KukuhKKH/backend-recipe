@extends('layouts.auth')

@section('content')
<div class="login">

    <div class="login-content">
        <form action="{{ route('login') }}" method="POST" id="login_form">
            @csrf
            <h1 class="text-center">Sign In</h1>
            <div class="text-white text-opacity-50 text-center mb-4">
                For your protection, please verify your identity.
            </div>
            <div class="mb-3">
                <label class="form-label">Username / Email Address <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-lg bg-white bg-opacity-5" value="{{ old('username') }}" name="username" placeholder="" />
                @error('username') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="mb-3">
                <div class="d-flex">
                    <label class="form-label">Password <span class="text-danger">*</span></label>
                    <a href="#" class="ms-auto text-white text-decoration-none text-opacity-50">Forgot password?</a>
                </div>
                <input type="password" class="form-control form-control-lg bg-white bg-opacity-5" value="" name="password" placeholder="" />
                @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="customCheck1" />
                    <label class="form-check-label" for="customCheck1">Remember me</label>
                </div>
            </div>
            <button type="submit" class="btn btn-outline-theme btn-lg d-block w-100 fw-500 mb-3">Sign
                In</button>
            @if (Route::has('register'))
                <div class="text-center text-white text-opacity-50">
                    Don't have an account yet? <a href="{{ route('register') }}">Sign up</a>.
                </div>
            @endif
        </form>
    </div>

</div>
@endsection
