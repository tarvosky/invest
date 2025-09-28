@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Edit Void Check</h4>
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


                <form action="{{ route('voidcheck.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">Company Name</label>
                                    <input type="text" value="{{ $data->company_name }}" name="company_name"
                                        class="form-control" id="inputEmail4" placeholder="TV ASSOCIATION OF REPUBLIC">
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="inputAddress">Street</label>
                                    <input type="text" value="{{ $data->company_street }}" name="company_street" 
                                        class="form-control" placeholder="P.O.BOX 1020 REPUBLIC">
                                </div>
                            </div>




                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputCity">Company City</label>
                                    <input name="company_city" value="{{ $data->company_city }}" class="form-control" type="text">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputZip">Company State </label>
                                    <select name="company_state" class="form-control">
                                       <option value="{{$data->company_state}}" @if ($data->company_state) selected="selected" @endif>{{ $state_arr[$data->company_state]}}</option>
                                        <option value="AL">Alabama</option>
                                        <option value="AK">Alaska</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="DC">District of Columbia</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VT">Vermont</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WA">Washington</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WY">Wyoming</option>
                                    </select>


                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputZip">Company Zip</label>
                                    <input value="{{ $data->company_zip }}" name="company_zip" class="form-control" type="number">
                                </div>
                            </div>







        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputZip">Bank Name</label>
                <input name="bank_name" value="{{ $data->bank_name }}"
                    class="form-control" type="text" placeholder="e.g North Trust Bank Plc">
           </div>

        <div class="form-group col-md-4">
            <label for="inputZip">Account Number</label>
            <input value="{{ $data->account_no }}" name="account_no"
                class="form-control" type="text" placeholder="123455667777">
        </div>
        <div class="form-group col-md-4">
            <label for="inputZip">Routing</label>
            <input value="{{ $data->routing_no }}" name="routing_no" class="form-control"
                type="text" placeholder="67777">
        </div>
        </div>


        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="inputAddress">Bank Street</label>
                <input type="text" value="{{ $data->bank_street }}"  name="bank_street" placeholder="P.O. Box 10566"
                    class="form-control">
            </div>
           <div class="form-group col-md-4">
                <label for="inputZip">Bank City</label>
                <input name="bank_city" placeholder="e.g Cleveland" value="{{ $data->bank_city }}"
                    class="form-control" type="text">

           </div>
        </div>


        <div class="form-row">


            <div class="form-group col-md-4">
                <label for="inputZip">Bank ZIP</label>
                 <input name="bank_zip" placeholder="e.g 1032" value="{{ $data->bank_zip }}"
                    class="form-control" type="number">

           </div>

            <div class="form-group col-md-4">
                <label for="inputZip">Bank State</label>
                               <select name="bank_state" class="form-control">
                             <option value="{{$data->bank_state}}" @if ($data->bank_state) selected="selected" @endif>{{ $state_arr[$data->bank_state]}}</option>
                                        <option value="AL">Alabama</option>
                                        <option value="AK">Alaska</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="DC">District of Columbia</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VT">Vermont</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WA">Washington</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
            </div>



                   <div class="form-group col-md-4">
                                <label for="inputZip">Type {{$data->type}}</label>
                               <select name="type"  class="form-control">
                               <option value="{{$data->type}}" @if ($data->type) selected="selected" @endif>{{ $array_type[$data->type]}}</option>
                                 <option value="void1" @if ($data->type == "void1") selected="selected" @endif>VOID 1</option>
                                  <option value="void2" @if ($data->type == "void2") selected="selected" @endif>VOID 2</option>
                                  <option value="void3" @if ($data->type == "void3") selected="selected" @endif>VOID 3</option>
                                  <option value="void4" @if ($data->type == "void4") selected="selected" @endif>VOID 4</option>
                             </select>
                            </div>
        </div>




 

                            <button type="submit" class="btn btn-secondary">Submit</button>
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
                    $("#fromDate").datepicker({
                        "dateFormat": "yy-mm-dd",
                        changeMonth: true,
                        changeYear: true,
                        showButtonPanel: true,                        
                    });
                    $("#toDate").datepicker({
                        "dateFormat": "yy-mm-dd",
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    });
            
                </script>
            @endpush
                