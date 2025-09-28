@extends('layouts.app_welcome')

@section('content')

	<div class="simple-page-wrap">
		<div class="simple-page-logo animated swing">
			<a href="{{asset('/')}}">
					<span> <img width="70px" height="70px"src="{{ asset('logo_footer.png')}}" alt="logo"></span>	<span>{{ config('app.name','site name') }}</span></a>
		</div><!-- logo -->
		<div class="simple-page-form animated flipInY" id="login-form">
	<h2 class="form-title m-b-xl text-center">Error 500</h2>
	<p>Internal Server Error</p>

</div><!-- #login-form -->

<div class="simple-page-footer">
    <p>
    <a  href="{{ route('home') }}">
        {{ __('Home') }}
    </a>

    </p>
	<p>

</div><!-- .simple-page-footer -->
</div><!-- .simple-page-wrap -->



















@endsection
