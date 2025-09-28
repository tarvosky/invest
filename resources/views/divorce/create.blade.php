@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Create Divorce Certificate</h4>
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

           

                    <form method="POST" action="{{ route('divorce-certificate.store') }}">
                        @csrf

                       


                         <div class="form-row">

                               <div class="form-group col-md-6">
                                <label for="inputEmail4">Court House Name</label>
                                <input type="text" value="{{ old('court_house_name') }}" name="court_house_name"
                                placeholder="eg MINNESOTA COURT HOUSE" class="form-control" id="inputEmail4">
                            </div>

                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Court County</label>
                            <input id="birth_date" type="text" value="{{ old('county') }}"  name="county"
                            placeholder="eg Henniepin County"  class="form-control" >
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                         <label for="inputEmail4">Husband Full Name</label>
                         <input type="text" value="{{ old('husband_name') }}" name="husband_name"
                         placeholder="eg Mr Ben Johnson" class="form-control" id="inputEmail4">
                     </div>

                 <div class="form-group col-md-6">
                     <label for="inputPassword4">Wife Full Name</label>
                     <input id="birth_date" type="text" value="{{ old('wife_name') }}"  name="wife_name"
                     placeholder="eg Mrs Kate Simpson"  class="form-control" >
                 </div>
             </div>


             <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputZip">Issued Date</label>
                <input id="issued_date" value="{{ old('issued_date') }}" name="issued_date" class="form-control"
                    type="text">
            </div>

            <div class="form-group col-md-6">
                <label for="inputZip">Divorce Date</label>
                <input id="divorce_date" value="{{ old('divorce_date') }}" name="divorce_date" class="form-control"
                    type="text">
            </div>
        </div>
                   

             <div class="form-row">
                <div class="form-group col-md-6">
                 <label for="inputEmail4">Judge First Name</label>
                 <input type="text" value="{{ old('judge_first_name') }}" name="judge_first_name"
                 placeholder="eg Abraham" class="form-control" id="inputEmail4">
             </div>

         <div class="form-group col-md-6">
             <label for="inputPassword4">Judge Last Name</label>
             <input id="birth_date" type="text" value="{{ old('judge_last_name') }}"  name="judge_last_name"
             placeholder="eg Mc Dowells"  class="form-control" >
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
    $("#divorce_date").datepicker({
"dateFormat": "yy-mm-dd",
   changeMonth: true,
   changeYear: true,
    });
    
</script>
@endpush