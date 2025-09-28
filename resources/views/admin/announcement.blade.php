@extends('layouts.app_home')
@section('css')
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Announcement</h4>
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
                                @if (Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif




















                                  <form action="{{ route('announcement.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Title</label>
                                <input type="text" value="{{ $data->title}}" name="title"
                                    class="form-control" id="inputEmail4">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputPassword4">Content</label>
                                <textarea  class="form-control"  name="message" id="" cols="30" rows="5">{{ $data->message}}</textarea>
                            </div>
                        </div>
                   
                  

                        <button type="submit" class="btn btn-outline-primary">Submit</button>
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
                
                
                
                