@extends('admin.layouts.auth')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-6 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                <div class="card-header border-0">
                                    <div class="text-center mb-1">
                                        <img src="{{ asset('app-assets/images/logo/logo.png') }}" alt="branding logo">
                                    </div>
                                    <div class="font-large-1  text-center">
                                        {{ __('Login') }}
                                    </div>
                                </div>
                                <div class="card-content">

                                    <div class="card-body">
                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @endif


                                        <form method="POST" action="{{ route('password.email') }}" class="form-horizontal">
                                            @csrf
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control round @error('email') is-invalid @enderror" id="email" name="email" placeholder="{{ __('E-Mail Address') }}" required>
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </fieldset>

                                            <div class="form-group text-center">
                                                <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1">{{ __('Send Password Reset Link') }}</button>
                                            </div>

                                        </form>
                                    </div>
                                    <p class="card-subtitle text-muted text-right font-small-3 mx-2"><span>Already a member ? <a href="{{ route('login') }}" class="card-link">Sign In</a></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>

@endsection
