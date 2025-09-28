
@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Enter SSN Information</h4>
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








                    <form method="POST" action="{{ route('socials.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">First Name</label>
                                <input type="text"placeholder="John"  value="{{ old('first_name') }}" name="first_name"
                                    class="form-control" id="inputEmail4">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Last Name</label>
                                <input type="text" placeholder="Williams" value="{{ old('last_name') }}" name="last_name"
                                    class="form-control" >
                            </div>


                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">SSN (Enter 9 digits)</label>
                                <input type="text" maxlength="9" placeholder="232431321" value="{{ old('ssn') }}" name="ssn"
                                    class="form-control" >
                            </div>
    
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Select side to download</label>
                                <select  name="view" class="form-control" >
                                    <option value="front-view">Front View</option>
                                    <option value="back-view">Back View</option>
                                    <option value="front-and-back-view">Front & Back View</option>
                                  </select>
                            </div>
                        </div>

                    <input type="hidden" value="sample.png" name="background">


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
                });
                $("#expiry_date").datepicker({
                    "dateFormat": "yy-mm-dd",
                });
                $("#birth_date").datepicker({
                    "dateFormat": "yy-mm-dd",
                });
                
            </script>
        @endpush






