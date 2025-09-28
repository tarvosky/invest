
@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-6">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Bank Statements</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">
                 <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{asset('video/statement.mp4')}}"></iframe>
                  </div>
</div><!-- .widget-body -->
</div><!-- .widget -->
</div><!-- END column -->




    <div class="col-md-6">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Driver's License</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
     <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="{{asset('video/dl.mp4')}}"></iframe>
      </div>
</div><!-- .widget-body -->
</div><!-- .widget -->
</div><!-- END column -->


            <div class="row">
                <div class="col-md-6">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Custom Statement & picture upload</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">
                 <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{asset('video/custom.mp4')}}"></iframe>
                  </div>
</div><!-- .widget-body -->
</div><!-- .widget -->
</div><!-- END column -->

<div class="col-md-6">
    <div class="widget">
        <header class="widget-header">
            <h4 class="widget-title">SMS Verification</h4>
        </header><!-- .widget-header -->
        <hr class="widget-separator">
        <div class="widget-body">
 <div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item" src="{{asset('video/sms.mp4')}}"></iframe>
  </div>
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

@push('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    $("#issued_date").datepicker({
        "dateFormat": "yy-mm-dd",
    });
    $("#expiry_date").datepicker({
        "dateFormat": "yy-mm-dd",
    });
    $("#birth_date").datepicker({
        "dateFormat": "yy-mm-dd",
    });
    
</script>
@endpush

