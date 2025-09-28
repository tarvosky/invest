@extends('layouts.app_welcome')

@section('content')

	<div class="simple-page-wrap">
		<div class="simple-page-logo animated swing">
			<a href="{{asset('/')}}">
					<span> <img width="70px" height="70px"src="{{ asset('logo_footer.png')}}" alt="logo"></span>	<span class="text-uppercase">{{ env("APP_NAME") }}</span></a>
		</div><!-- logo -->
		<div class="simple-page-form animated flipInY" id="login-form">
	<h4 class="form-title m-b-xl text-center">Sign In </h4>
    <form method="POST" action="{{ route('login') }}">
    @csrf
		<div class="form-group">
           <input placeholder="Username" id="sign-in-email" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        </div>

		<div class="form-group">
            <input placeholder="Password" id="sign-in-password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
		</div>

		<div class="form-group m-b-xl">
			<div class="checkbox checkbox-primary">
                <input id="keep_me_logged_in" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
				<label for="keep_me_logged_in">Keep me signed in</label>
			</div>
		</div>
		<input type="submit" class="btn btn-primary" value="SIGN IN">
	</form>
</div><!-- #login-form -->

<div class="simple-page-footer">
    <p>
    @if (Route::has('password.request'))
    <a  href="{{ route('password.request') }}">
        {{ __('Forgot Your Password?') }}
    </a>
    @endif
    </p>
	<p>
		<small>Don't have an account ?</small>
		<a href="{{asset('register')}}">CREATE AN ACCOUNT</a>
	</p>
    	<p>
{{--		<a>We get you verified / Мы проверим вас</a>--}}
	   </p>
</div><!-- .simple-page-footer -->
</div><!-- .simple-page-wrap -->



















@endsection
