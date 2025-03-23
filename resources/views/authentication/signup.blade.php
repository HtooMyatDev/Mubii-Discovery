@extends('authentication.layouts.master')
@section('title')
Mubii Discover | Sign Up
@endsection
@section('content')
    <div class="layer"></div>
    <main class="page-center">
        <article class="sign-up">
            <h1 class="sign-up__title">Get started</h1>
            <p class="sign-up__subtitle">
                Start creating the best possible user experience for you customers
            </p>
            <form class="sign-up-form form" action="{{ route('register') }}" method="POST">
                @csrf
                <label class="form-label-wrapper">
                    <p class="form-label">Name</p>
                    <input class="form-input" type="text" placeholder="Enter your name" name="name"
                        value="{{ old('name') }}" />
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </label>

                <label class="form-label-wrapper">
                    <p class="form-label">Email</p>
                    <input class="form-input" type="email" placeholder="Enter your email" name="email"
                        value="{{ old('email') }}" />
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </label>

                <label class="form-label-wrapper">
                    <p class="form-label">Password</p>
                    <input class="form-input" type="password" placeholder="Enter your password" name="password" />
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </label>

                <label class="form-label-wrapper">
                    <p class="form-label">Password Confirmation</p>
                    <input class="form-input" type="passworrd" placeholder="Enter your password again"
                        name="password_confirmation" />
                    @error('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </label>

                <label class="form-checkbox-wrapper">
                    <input class="form-checkbox" type="checkbox" />
                    <span class="form-checkbox-label">Remember me next time</span>
                </label>
                <button type="submit" value="register" class="btn btn-primary w-100">Sign up</button>
                <p class="mt-3"> Already have an account?
                    <a href="{{ route('login') }}">Login</a>
                </p>
            </form>
        </article>
    </main>
@endsection
