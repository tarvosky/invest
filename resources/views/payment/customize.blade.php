@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-6">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Image Edit Request</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                         @endif


                            <form method="POST" enctype="multipart/form-data" action="{{ route('payment.post.customize') }}" >
                             @csrf
							<div class="form-group">
                                <strong>Description</strong>: <br>
                                <label  for="inputPassword4">{{ $data->description}}</label> <br>
                                <strong>Amount</strong>:
                                <label  for="inputPassword4">${{ $data->amount}}</label>
                                <input type="hidden" name="amount" value="{{ $data->amount}}" />
                                <input type="hidden" name="description" value="{{ $data->description}}" />
                                  <input type="hidden" name="slug" value="{{ $data->slug}}" />
                                <input type="file" name="image" placeholder="Choose image" id="image">
							</div>
							<button type="submit" onclick=" return confirm('Are you sure ? you will be charged $' + {{ $data->amount}})  " confirm class="btn btn-primary">Order Now</button>
						</form>




                    </div><!-- .widget-body -->
                </div><!-- .widget -->
                </div><!-- END column -->
                </div>
                
                <div class="row">
                    @include('partials/news')
                </div><!-- .row -->
                
                
                <div class="row">
                @include('partials/banner')
                </div><!-- .row -->
                
                @endsection
                
               
                
                