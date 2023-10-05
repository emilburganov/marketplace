@extends('layouts.app')

@section('content')
    <main>
        {{-- Signin page --}}
        <section class="auth">
            <div class="container auth__container">
                <img src="{{ Vite::asset('resources/assets/images/auth/background.png') }}" alt="signup">
                <form class="form" action="{{ route('postSignin') }}" method="POST">
                    @csrf
                    <div class="form__title">
                        <h3>Sign in to Marketplace</h3>
                        <p>Enter your details below</p>
                    </div>
                    <div class="form__fields">
                        <label>
                            <input
                                class="form-input"
                                type="email"
                                placeholder="Email"
                                name="email"
                                required>
                        </label>
                        <label>
                            <input
                                class="form-input"
                                type="password"
                                placeholder="Password"
                                name="password"
                                autocomplete
                                required>
                        </label>
                    </div>
                    <div class="form__buttons">
                        <button type="submit" class="button primary-button">
                            Sign in
                        </button>
                        @error('message')
                        <span class="form__error form__base-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <p class="form__link">
                        Don't have an account?
                        <a href="{{ route('signup') }}">
                            Sing up
                        </a>
                    </p>
                </form>
            </div>
        </section>
    </main>
@endsection
