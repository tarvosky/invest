
@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Create Paystub</h4>
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


                    <form method="POST" action="{{ route('paystubs.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Company Name</label>
                                <input type="text"placeholder="Matrix Manufacturing INC"  value="{{ old('company_name') }}" name="company_name"
                                    class="form-control" id="inputEmail4">
                            </div>
                        </div>



                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputZip">Company Street</label>
                            <input value="{{ old('company_street') }}" name="company_street"
                            placeholder="ex. P.O.Box 12323 town avenue" class="form-control" type="text">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputZip">Company City</label>
                            <input placeholder="City (ex.Cleveland)" value="{{ old('company_city') }}" name="company_city" class="form-control"
                                type="text">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail3">Company Zip</label>
                            <input   type="text"  value="{{ old('company_zip') }}" name="company_zip"
                                class="form-control" >
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputCity">Company State</label>
                            <select name="company_state"  class="form-control">
                                <option value="">Select</option>
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
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Employee Full Name</label>
                            <input type="text"placeholder="Samuel Willaims"  value="{{ old('name') }}" name="name"
                                class="form-control" id="inputEmail4">
                        </div>
                    </div>



                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputZip">Employee Street</label>
                        <input value="{{ old('street') }}" name="street"
                        placeholder="ex. P.O.Box 12323 town avenue" class="form-control" type="text">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputZip">Employee City</label>
                        <input placeholder="City (ex.Cleveland)" value="{{ old('city') }}" name="city" class="form-control"
                            type="text">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputEmail3">Employee Zip</label>
                        <input   type="text"  value="{{ old('zip') }}" name="zip"
                            class="form-control" >
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputCity">Employee State</label>
                        <select name="state"  class="form-control">
                            <option value="">Select</option>
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
                </div>


                        <div class="form-row">

                            <div class="form-group col-md-3">
                                <label for="inputZip">Employee SSN (number only)</label>
                                <input value="{{ old('ssn') }}" maxlength="9" name="ssn" class="form-control"
                                    placeholder="123456789" type="text">
                            </div>


                            <div class="form-group col-md-3">
                                <label for="inputZip">Annual Pay</label>
                                <input value="{{ old('annual_pay') }}"  placeholder="90000.00" name="annual_pay" class="form-control"
                                    type="text">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputZip">Pay Date</label>
                                <input id="pay_date" value="{{ old('pay_date') }}" name="pay_date" class="form-control"
                                    type="text">
                            </div>


                            <div class="form-group col-md-3">
                                <label for="inputZip">Pay Type</label>
                                <select  name="pay_type" class="form-control" >
                                    <option value="weekly">WEEKLY</option>
                                    <option value="bi-weekly">BI-WEEKLY</option>
                                    <option value="monthly">MONTHLY</option>
                                  </select>
                            </div>
                        </div>
                        


                        <div class="form-row">


     

                            <div class="form-group col-md-12">
                                <label for="inputZip">Paystub Type</label>
                                <select  name="type" class="form-control" >
                                    <option value="type1">TYPE 1</option>
                                    <option value="type2">TYPE 2</option>
                                    <option value="type3">TYPE 3</option>
                                  </select>
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
                $("#pay_date").datepicker({
            "dateFormat": "yy-mm-dd",
               changeMonth: true,
               changeYear: true,
                });
                
            </script>
        @endpush