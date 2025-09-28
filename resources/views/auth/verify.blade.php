@extends('layouts.app_welcome')
@section('content')
	<div class="simple-page-wrap">
		<div class="simple-page-logo animated swing">
			<a href="{{asset('/')}}">
							<span> <img width="70px" height="70px"src="{{ asset('logo_footer.png')}}" alt="logo"></span>	<span>{{ config('app.name','site name') }}</span>
			</a>
		</div><!-- logo -->
		<div class="simple-page-form animated flipInY" id="reset-password-form">
        	<h4 class="form-title m-b-xl text-center">{{ __('Verify Your Email Address') }}</h4>
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},

                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>


          </div><!-- #reset-password-form -->
	</div><!-- .simple-page-wrap -->



@endsection
