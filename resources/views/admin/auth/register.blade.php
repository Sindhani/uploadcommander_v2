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
                        <div class="col-lg-5 col-md-6 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                <div class="card-header border-0">
                                    <div class="text-center mb-1">
                                        <img src="{{ asset('app-assets/images/logo/logo.png') }}" alt="branding logo">
                                    </div>
                                    <div class="font-large-1 text-center">
                                        {{ __('Create Account') }}
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form-horizontal" action="{{ route('register') }}" novalidate method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <fieldset class="form-group position-relative">
                                                        <input type="text" class="form-control round @error('first_name') is-invalid @enderror" id="first_name" name="first_name" placeholder="{{ __('First Name') }}" tabindex="1" required value="{{ old('first_name') }}">
                                                        @error('first_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </fieldset>
                                                    <fieldset class="form-group position-relative">
                                                        <input type="text" class="form-control round @error('email') is-invalid @enderror" id="email" name="email" placeholder="{{ __('E-Mail Address') }}" tabindex="3" required value="{{ old('email') }}">
                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </fieldset>
                                                    <fieldset class="form-group position-relative">
                                                        <input type="password" class="form-control round @error('password') is-invalid @enderror" id="password" name="password" placeholder="{{ __('Password') }}"  tabindex="5" required value="{{ old('password') }}">
                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-6">
                                                    <fieldset class="form-group position-relative">
                                                        <input type="text" class="form-control round @error('surname') is-invalid @enderror" id="surname" name="surname" placeholder="{{ __('Surname') }}"  tabindex="2" required value="{{ old('surname') }}">
                                                        @error('surname')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </fieldset>
                                                    <fieldset class="form-group position-relative">
                                                        <select name="timezone" id="timezone" class="form-control round @error('timezone') is-invalid @enderror" required tabindex="4" value="{{ old('timezone') }}">
                                                            <option value="">Select Timezone</option>
                                                            @foreach($timezoneList as $timezoneKey=>$timezoneValue)
                                                                <option value="{{ $timezoneKey }}">{{ $timezoneValue }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('timezone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </fieldset>
                                                    <fieldset class="form-group position-relative">
                                                        <input type="password" class="form-control round @error('confirmed') is-invalid @enderror" id="password-confirm" name="password_confirmation" tabindex="6" placeholder="{{ __('Confirm Password') }}" required>
                                                        @error('confirmed')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </fieldset>
                                                </div>
                                            </div>

                                            <div class="form-group text-center">
                                                <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1">{{ __('Register') }}</button>
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
