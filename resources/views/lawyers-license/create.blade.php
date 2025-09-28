@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Lawyers License</h4>
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

           

                    <form method="POST" action="{{ route('lawyers-license.store') }}">
                        @csrf

                       


                         <div class="form-row">

                               <div class="form-group col-md-6">
                                <label for="inputEmail4">Laywer's Full Name</label>
                                <input type="text" value="{{ old('full_name') }}" name="full_name"
                                placeholder="eg Samuel Alison" class="form-control" id="inputEmail4">
                            </div>

                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Law Firm Name</label>
                            <input  type="text" value="{{ old('law_firm_name') }}"  name="law_firm_name"
                            placeholder="eg xyz Solisitors LTD"  class="form-control" >
                        </div>
                    </div>





    <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputZip">Issued Date</label>
                <input id="issued_date" value="{{ old('issued_date') }}" name="issued_date" class="form-control"
                    type="text">
            </div>

            <div class="form-group col-md-6">
                <label for="inputZip">License State</label>
                <input value="{{ old('license_state') }}" name="license_state" class="form-control"
                   placeholder="eg San Fransico"  type="text">
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






@push('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    $("#issued_date").datepicker({
"dateFormat": "yy-mm-dd",
   changeMonth: true,
   changeYear: true,
    });
    
</script>
@endpush