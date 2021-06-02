@extends('Frontend.layouts.master')

@section('content')
    <div class="login-register-area pt-115 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav">
                            <a href="{{route('login')}}">
                                <h4> login </h4>
                            </a>
                            <a href="{{route('register')}}">
                                <h4> register </h4>
                            </a>
                        </div>
                        <div class="tab-content">
                            <div id="lg1" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">

                                        <form  method="post" action="{{ route('register') }}" >
                                            @csrf

                                            <input name="name" placeholder="Name" type="text" class=" @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <input name="email" placeholder="Email" type="email" class=" @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <input type="password" name="password" placeholder="Password (minimum 8 characters)" class=" @error('password') is-invalid @enderror" value="{{ old('password') }}" required autocomplete="new-password" autofocus>

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <input type="password" name="password_confirmation" placeholder="Confirm Password" class=" @error('password') is-invalid @enderror" value="{{ old('password') }}" required autocomplete="new-password" autofocus>

                                            <div class="button-box">
                                                <div class="login-toggle-btn">
                                                    <input name="remember" id="remember" type="checkbox">
                                                    <label for="remember">Remember me</label>
                                                   
                                                <button type="submit">Register</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection