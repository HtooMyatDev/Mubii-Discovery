@extends('authentication.layouts.master')
@section('title')
Mubii Discover | Sign In
@endsection
@section('content')
    <div class="layer"></div>
    <main class="page-center">
        <article class="sign-up pt-5 shadow-sm">
            <h1 class="sign-up__title">Welcome back!</h1>
            <p class="sign-up__subtitle">Sign in to your account to continue</p>
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
                <div class="mt-2 row text-center text-secondary">
                    <span>or</span>
                </div>
                <a href="/auth/google/redirect" class="btn btn-outline-secondary w-100 text-center">
                    <i class="fa-brands fa-google me-2"></i>
                    <span>Sign in with Google</span></a>

                    <a href="/auth/github/redirect" class="w-100 btn btn-outline-dark mt-2">
                        <i class="fa-brands fa-github me-2"></i>
                        <span>Sign in with Github</span>
                    </a>
                <p class="mt-3 text-secondary">Don't have an account yet? <a href="{{ route('register') }}">Sign up</a></p>
            </form>
        </article>
    </main>
@endsection
