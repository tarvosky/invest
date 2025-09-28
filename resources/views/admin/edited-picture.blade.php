@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-6">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Edited Picture</h4>
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


                            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.post.picture') }}" >
                             @csrf
							<div class="form-group">
                                <strong>Email</strong>: 
                                <input class="form-control" type="email" name="email" value="" /><br>
                                <strong>Upload Image</strong>: 
                                <input type="file" name="image" placeholder="Choose image" id="image">
							</div>
							<button type="submit" confirm class="btn btn-primary">Submit</button>
						</form>




                    </div><!-- .widget-body -->
                </div><!-- .widget -->
                </div><!-- END column -->





                <div class="col-md-6">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Picture</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">

                            @if($image =! "" || isset($image))
                            <img src="{{ asset( $image )}}" alt="">
                            @endif
                        
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
                
               
                
                