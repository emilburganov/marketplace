@extends('layouts.app')

@section('content')
    <main>
        {{-- Signup page --}}
        <section class="auth">
            <div class="container auth__container">
                <img src="{{ Vite::asset('resources/assets/images/auth/background.png') }}" alt="signup">
                <form class="form" action="{{ route('postSignup') }}" method="POST">
                    @csrf
                    <div class="form__title">
                        <h3>Sign up to Marketplace</h3>
                        <p>Enter your details below</p>
                    </div>
                    <div class="form__fields">
                        <label>
                            <input
                                class="form-input"
                                type="text"
                                placeholder="Name"
                                name="name"
                                value="{{ old('name') }}"
                                required>
                            @error('name')
                            <span class="form__error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </label>
                        <label>
                            <input
                                class="form-input"
                                type="email"
                                placeholder="Email"
                                name="email"
                                value="{{ old('email') }}"
                                required>
                            @error('email')
                            <span class="form__error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </label>
                        <label>
                            <input
                                class="form-input"
                                type="password"
                                placeholder="Password"
                                name="password"
                                value="{{ old('password') }}"
                                required>
                            @error('password')
                            <span class="form__error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </label>
                        <label>
                            <input
                                class="form-input"
                                type="password"
                                placeholder="Password Repeat"
                                name="password_repeat"
                                value="{{ old('password_repeat') }}"
                                required>
                            @error('password_repeat')
                            <span class="form__error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </label>
                    </div>
                    <div class="form__buttons">
                        <button type="submit" class="button primary-button">
                            Sign up
                        </button>
                    </div>
                    <p class="form__link">
                        Already have account?
                        <a href="{{ route('signin') }}">
                            Sign in
                        </a>
                    </p>
                </form>
            </div>
        </section>
    </main>
@endsection
