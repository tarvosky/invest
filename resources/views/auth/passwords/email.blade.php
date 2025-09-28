@extends('layouts.app_welcome')

@section('content')



	<div class="simple-page-wrap">
		<div class="simple-page-logo animated swing">
			<a href="{{asset('/')}}">
					<span> <img width="70px" height="70px"src="{{ asset('logo_footer.png')}}" alt="logo"></span>	<span>{{ config('app.name','site name') }}</span>	</a>
		</div><!-- logo -->
		<div class="simple-page-form animated flipInY" id="reset-password-form">

	<h4 class="form-title m-b-xl text-center">{{ __('Reset Password') }}</h4>
                            @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
        <form method="POST" action="{{ route('password.email') }}">
        @csrf
		<div class="form-group">
            <input placeholder="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
		</div>
		                              <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
	</form>
</div><!-- #reset-password-form -->

	</div><!-- .simple-page-wrap -->













@endsection
