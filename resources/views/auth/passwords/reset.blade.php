@extends('layouts.app_welcome')

@section('content')

	<div class="simple-page-wrap">
		<div class="simple-page-logo animated swing">
			<a href="{{asset('/')}}">
					<span> <img width="70px" height="70px"src="{{ asset('logo_footer.png')}}" alt="logo"></span>	<span>{{ config('app.name','site name') }}</span>	</a>
		</div><!-- logo -->
		<div class="simple-page-form animated flipInY" id="reset-password-form">

	<h4 class="form-title m-b-xl text-center">{{ __('Reset Password') }}</h4>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <input placeholder="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                                    <input placeholder="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                    </div>
        <div class="form-group">
              <input placeholder="password-confirm" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                    </form>
    </div><!-- #reset-password-form -->
	</div><!-- .simple-page-wrap -->


@endsection
