@extends('authentication.layouts.master')
@section('title')
    Mubii Discover | Sign In
@endsection
@section('content')
    <div class="layer"></div>
    <main class="page-center text-center">
        <article class="sign-up pt-5 shadow-sm w-25">
            <h1 class="sign-up__title">Welcome back!</h1>
            <p class="fs-6 text-secondary">Sign in to your account to continue</p>
            <form class="sign-up-form form" action="{{ route('login') }}" method="post">
                @csrf
                <label class="form-label-wrapper">
                    <p class="form-label">Email</p>
                    <input class="form-input" type="email" placeholder="Enter your email" name="email"
                        value="{{ old('email') }}" />
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </label>
                <label class="form-label-wrapper mt-3">
                    <p class="form-label">Password</p>
                    <input class="form-input" type="password" placeholder="Enter your password" name="password" />
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </label>
                <a class="link-info forget-link" href="##">Forgot your password?</a>
                <label class="form-checkbox-wrapper">
                    <input class="form-checkbox" type="checkbox" />
                    <span class="form-checkbox-label">Remember me next time</span>
                </label>
                <button type="submit" value="login" class="btn btn-primary w-100">Login</button>

                <p class="mt-3 text-secondary">Don't have an account yet? <a href="{{ route('register') }}">Sign up</a></p>
            </form>
        </article>
    </main>
@endsection
