@extends('layouts.guest')

@section('content')
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
{{--                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>--}}
                            <img src="images/bkacad.png" alt="" class="row col-lg-7 d-none d-lg-block">
                        <div class="col-lg-5">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">{{ __('Chào mừng trở lại !') }}</h1>
                                </div>
                                <form action="{{ route('login') }}" method="post" class="user">
                                    @csrf

                                    <div class="form-group">
                                        <input type="email" name="email" value="{{ old('email') }}"
                                               class="form-control form-control-user @error('email') is-invalid @enderror"
                                               id="exampleInputEmail" aria-describedby="emailHelp"
                                               placeholder="{{ __('Nhập Email') }}" required autofocus>
                                    </div>
                                    @error('email')
                                    <div class="form-group custom-control">
                                        <label class="">{{ $message }}</label>
                                    </div>
                                    @enderror

                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                               id="exampleInputPassword" placeholder="{{ __('Mật khẩu') }}" required>
                                    </div>
                                    @error('password')
                                    <div class="form-group custom-control">
                                        <label class="">{{ $message }}</label>
                                    </div>
                                    @enderror
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ __('Login') }}
                                    </button>
                                </form>
{{--                                <hr>--}}
{{--                                @if (Route::has('password.request'))--}}
{{--                                <div class="text-center">--}}
{{--                                    <a class="small" href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>--}}
{{--                                </div>--}}
{{--                                @endif--}}
{{--                                @if (Route::has('register'))--}}
{{--                                <div class="text-center">--}}
{{--                                    <a class="small" href="{{ route('register') }}">{{ __('Create New Account!') }}</a>--}}
{{--                                </div>--}}
{{--                                @endif--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
