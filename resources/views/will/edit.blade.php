@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Edit Will</h4>
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

           
             

                        <form action="{{ route('wills.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')  



         





                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputPassword4">Law Firm Name</label>
                            <input  type="text" value="{{ $data->law_firm_name }}"  name="law_firm_name"
                            placeholder="eg xyz Solisitors LTD"  class="form-control" >
                        </div>
                        <div class="form-group col-md-5">
                                <label for="inputEmail4">Law Firm Address</label>
                                <input type="text" value="{{ $data->law_firm_address }}" name="law_firm_address"
                                placeholder="eg xyz Adam smith Avenue thomas county 232011" class="form-control" id="inputEmail4">
                        </div>
                        <div class="form-group col-md-3">
                                <label for="inputEmail4">Law Firm Country</label>
                                <input type="text" value="{{ $data->law_firm_country }}" name="law_firm_country"
                                placeholder="eg UAE" class="form-control" id="inputEmail4">
                        </div>
                    </div>




                 <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="inputPassword4">Testator</label>
                            <input  type="text" value="{{ $data->testator }}"  name="testator"
                            placeholder="eg Mary Hockins"  class="form-control" >
                        </div>
                        <div class="form-group col-md-7">
                                <label for="inputEmail4">testator Address</label>
                                <input type="text" value="{{ $data->testator_address }}" name="testator_address"
                                placeholder="eg xyz Adam smith Avenue thomas county 232011" class="form-control" id="inputEmail4">
                        </div>
                    </div>




                 <div class="form-row">
                        <div class="form-group col-md-7">
                            <label for="inputPassword4">Dating Name (Working name)</label>
                            <input  type="text" value="{{ $data->dating_name }}"  name="dating_name"
                            placeholder="eg John Smith"  class="form-control" >
                        </div>
                        <div class="form-group col-md-5">
                                <label for="inputEmail4">Relationship (Dating Connection)</label>
                                <select name="dating_connection" id=""  class="form-control">
                                 <option value="{{$data->dating_connection}}">{{$data->dating_connection}}</option>
                                <option value="Daughter">Daughter</option>
                                <option value="Son">Son</option>
                                <option value="Ex-wife">Ex-wife</option>
                                <option value="Ex-husband">Ex-husband</option>
                                <option value="Fiance">Fiance</option>
                                <option value="Fiancee">Fiancee</option>
                                <option value="Husband">Husband</option>
                                <option value="Wife">Wife</option>
                                <option value="Cousin">Cousin</option>
                                <option value="Nephew">Nephew</option>
                                 <option value="Niece">Niece</option>
                                </select>
                        </div>
                    </div>



                 <div class="form-row">
                        <div class="form-group col-md-7">
                            <label for="inputPassword4">Client Name</label>
                            <input  type="text" value="{{ $data->client_name }}"  name="client_name"
                            placeholder="eg John Smith"  class="form-control" >
                        </div>
                        <div class="form-group col-md-5">
                                <label for="inputEmail4">Relationship (Client Connection)</label>
                                <select name="client_connection" id="" class="form-control">
                                  <option value="{{$data->client_connection}}">{{$data->client_connection}}</option>
                                <option value="Daughter">Daughter</option>
                                <option value="Son">Son</option>
                                <option value="Ex-wife">Ex-wife</option>
                                <option value="Ex-husband">Ex-husband</option>
                                <option value="Fiance">Fiance</option>
                                <option value="Fiancee">Fiancee</option>
                                <option value="Husband">Husband</option>
                                <option value="Wife">Wife</option>
                                <option value="Cousin">Cousin</option>
                                <option value="Nephew">Nephew</option>
                                 <option value="Niece">Niece</option>
                                </select>
                        </div>
                    </div>


        <div class="form-row">

             <div class="form-group col-md-3">
                <label for="inputZip">Lawyer's Name</label>
                <input  value="{{ $data->lawyer }}" name="lawyer" class="form-control"
                    type="text">
            </div>
            <div class="form-group col-md-3">
                <label for="inputZip">Issued Date</label>
                <input id="issued_date" value="{{ $data->issued_date }}" name="issued_date" class="form-control"
                    type="text">
            </div>

            <div class="form-group col-md-3">
                <label for="inputZip">Amount (numbers only)</label>
                <input value="{{ $data->amount }}" name="amount" class="form-control"
                   placeholder="eg 5000"  type="text">
            </div>
            <div class="form-group col-md-3">
                <label for="inputZip">Currency</label>
               <select name="currency" id=""  class="form-control">
               <option value="{{ $data->currency }}">{{ $data->currency }}</option>
                      <option value="Dollars">Dollars</option>
                      <option value="Pounds">Pounds</option>
                      <option value="Euros">Euro</option>
                </select>                
            </div>
        </div>
                   
                   

                 <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Property ( incase of more than one property sperate using "," and "and")</label>
                            <textarea  class="form-control" name="property" id="" cols="30" rows="10" placeholder=" eg  A property at 453 Southfield Way, Atlanta, GA 30020   and Another property in New jersey ">{{ $data->property }}</textarea>
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