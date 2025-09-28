@extends('layouts.app')
@include('partials/banner')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background:#015AFF;color:white">{{ __('Dashboard') }}</div>

                <div class="card-body" >
                    <img src="{{asset('license/test/'.$image ) }}" alt="image">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
