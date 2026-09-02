{{--<x-guest-layout>--}}
{{--    <form method="POST" action="{{ route('register') }}">--}}
{{--        @csrf--}}

{{--        <!-- Name -->--}}
{{--        <div>--}}
{{--            <x-input-label for="name" :value="__('Name')" />--}}
{{--            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />--}}
{{--            <x-input-error :messages="$errors->get('name')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Email Address -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}

{{--            <x-text-input id="password" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password"--}}
{{--                            required autocomplete="new-password" />--}}

{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Confirm Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />--}}

{{--            <x-text-input id="password_confirmation" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password_confirmation" required autocomplete="new-password" />--}}

{{--            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">--}}
{{--                {{ __('Already registered?') }}--}}
{{--            </a>--}}

{{--            <x-primary-button class="ms-4">--}}
{{--                {{ __('Register') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</x-guest-layout>--}}


@extends('admin.app-user')
@section('content')
    <main class="auth-page">
    <section class="auth-card">
        <a class="auth-brand" href="index.html"><span class="brand-icon"><i class="bi bi-grid-1x2-fill" aria-hidden="true"></i></span><span><strong>adminHMD</strong><small>Create your adminHMD account.</small></span></a>
        <div class="auth-visual"><img src="../assets/images/png/dasher-ui-bootstrap-5.jpg" alt="adminHMD dashboard interface"></div>
        <form class="needs-validation" method="POST" action="{{ route('register') }}" novalidate>
            @csrf
            <div class="mb-4">
                <p class="eyebrow mb-1">Secure Access</p>
                <h1 class="h3 mb-1">Register</h1>
                <p class="text-muted mb-0">Create your account.</p>
            </div>
            <div class="mb-3">
                <label class="form-label" for="registerName">Full name</label>
                <input class="form-control" id="name" name="name" :value="old('name')" type="text" required>
                <div class="invalid-feedback">Full name is required.</div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="registerEmail">Email address</label>
                <input class="form-control" id="email" name="email" :value="old('email')" type="email" required>
                <div class="invalid-feedback">Enter a valid email.</div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="registerPassword">Password</label>
                <input class="form-control" id="password" type="password" name="password" minlength="6" required>
                <div class="invalid-feedback">Password must be at least 6 characters.</div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="registerPassword">Conform Password</label>
                <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" minlength="6" required>
                <div class="invalid-feedback">Password must be at least 6 characters.</div>
            </div>
            <button class="btn btn-primary w-100" type="submit"><i class="bi bi-person-plus" aria-hidden="true"></i> Create Account</button>
        </form>

        <div class="auth-footer">Already have an account? <a href="login.html">Sign in</a></div>
    </section>
    </main>
@endsection
