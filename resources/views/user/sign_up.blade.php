@extends('user.layouts.layout')
@section('title', 'Sign Up')
@section('content')

<br>
<br>
<div class="rts-sign-up-section mt-5">
    <div class="section-inner">
        <div class="logo-area">
            <a href="{{ route('home') }}"><img src="{{ asset('user-assets/images/logo/logo-4.svg') }}" alt=""></a>
        </div>
        <form action="{{ route('user.register') }}" method="POST">
            @csrf
            <h2 class="form-title">Sign up</h2>
            @if ($errors->any())
                <div class="alert alert-danger text-start py-0">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-inner">
                <div class="single-wrapper">
                    <input type="text" name="first_name" placeholder="First name" value="{{ old('first_name')}}" required>
                </div>
                <div class="single-wrapper">
                    <input type="text" name="last_name" placeholder="Last name" value="{{ old('last_name')}}" required>
                </div>
                <div class="single-wrapper">
                    <input type="email" name="email" placeholder="Your email" value="{{ old('email')}}" required>
                </div>
                <div class="single-wrapper">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="check">
                    <div class="check-box-area">
                        <input type="checkbox" id="terms_and_conditions" name="terms_and_conditions" value="1" required/>
                        <label for="terms_and_conditions">I read and accept all <a href="#">terms & conditions</a></label>
                    </div>
                </div>
                <div class="form-btn">
                    <button type="submit" class="primary__btn">Create an account</button>
                </div>
            </div>
            <p class="sign-in-option">You already have an account? <a href="{{ route('login') }}">Sign in</a></p>
        </form>
    </div>
    <div class="copyright-area">
        <p>Copyright 2023. All Rights Reserved.</p>
    </div>
</div>
@endsection

@push('style')
    <style>
        .rts-sign-up-section .section-inner form {
            max-width: 450px;
        }
    </style>
@endpush