
@extends('layouts.app_home')
@section('content')

            <div class="row">
                <div class="col-md-6">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">VOID CHECKS</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">

                          <div class="text-center">
                            @if($data->logo == null)
                            <img  width="120px" height="120px" id="myImg" src="{{ asset('voidchecks/logos/logo.png')}}" class=" pb-2" alt="...">
                            @else 
                            <img   width="120" height="60" id="myImg" src="{{ asset('voidchecks/logos/'.$data->logo)}}" class=" pb-2" alt="...">
                            @endif
                      </div>


          </div><!-- .widget-body -->
          </div><!-- .widget -->
          </div><!-- END column -->




    <div class="col-md-6">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Back to Void Checks</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
              <div class="text-center mt-5 mt-5">
                <a class="btn btn-danger btn-lg" href="{{ asset('voidcheck')}}"> Finish >> </a>
            </div>

</div><!-- .widget-body -->
</div><!-- .widget -->
</div><!-- END column -->



<div class="col-md-12">
  <div class="widget">
      <header class="widget-header">
          <h4 class="widget-title">Upload your Bank Logo</h4>
      </header><!-- .widget-header -->
      <hr class="widget-separator">
      <div class="widget-body">

        @if ($message = Session::get('success'))
                          <div class="alert alert-success">
                              <strong>{{ $message }}</strong>
                          </div>
                          @endif

                          @if (count($errors) > 0)
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                          @endif
            <p>To get the best experience make sure to review the following</p>
            <ul>
                <li> <b>You can search for the bank logo from this </b>  <a target="_blank" href="http://www.google.com/imghp">link</a> </li>
                <li>To get the best upload logo with height of 120px</li>
                <li>The image must not be more than 1mb</li>
                <li>After you click on the "upload button" below, you will find the picture you just uploaded among the pictures above</li>
               <li class="text-danger"> Make sure the logo has been cropped and trimmed for white spaces very important!!!!!!!!</li>
            </ul>


            <form method="POST" enctype="multipart/form-data" action="{{ url('voidcheck/upload-logo') }}" >
              @csrf
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <input type="file" name="image" placeholder="Choose image" id="image">
                          <input type="hidden" name="voidcheck_id" value="{{ $data->id}}" />
                          
                      </div>
                  </div>
                    
                  <div class="col-md-12">
                      <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
              </div>     
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


