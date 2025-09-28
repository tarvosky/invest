@extends('layouts.app_welcome')

@section('content')
	<div class="simple-page-wrap">
		<div class="simple-page-logo animated swing">
			<a href="{{asset('/')}}">
					<span> <img width="70px" height="70px"src="{{ asset('logo_footer.png')}}" alt="logo"></span>	<span>{{ config('app.name','site name') }}</span>	</a>
		</div><!-- logo -->
		<div class="simple-page-form animated flipInY" id="reset-password-form">

	<h4 class="form-title m-b-xl text-center">{{ __('Confirm Password') }}</h4>
                       {{ __('Please confirm your password before continuing.') }}
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                    <div class="form-group">
                        <input placeholder="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                               @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                            <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif


                    </form>
          </div><!-- #reset-password-form -->
	</div><!-- .simple-page-wrap -->
@endsection
