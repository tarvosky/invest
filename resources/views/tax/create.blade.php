@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Enter Tax 1040 Schedule C</h4>
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



                    <form method="POST" action="{{ route('tax-documents.store') }}">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputZip">Select Year</label>
                                <select name="year"  class="form-control">
                                    <option value="">Select</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    {{-- <option value="2021">2021</option> --}}
                                </select> 
                            </div>
                               <div class="form-group col-md-6">
                                <label for="inputEmail4">Full Name</label>
                                <input type="text" value="{{ old('full_name') }}" name="full_name"
                                placeholder="eg Richard Brandson" class="form-control" id="inputEmail4">
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Business Name</label>
                                <input type="text" value="{{ old('business_name') }}" name="business_name"
                                placeholder="eg INDUSTRIAL MACHINERY INC" class="form-control" id="inputEmail4">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">Business Description</label>
                                <input type="text" value="{{ old('business_description') }}" name="business_description"
                                placeholder="eg INDUSTRIAL MACHINERY PARTS AND EQIUPMENTS SALES " class="form-control" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">Instruction Code <span style="font-size:11px">click <a target="_blank" href="https://www.naics.com/search/">link</a> to search for code</span></label>
                                <input type="text" value="{{ old('instruction_code') }}" name="instruction_code"
                                placeholder="eg 111110"   class="form-control" >
                            </div>
                        </div>

                     <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4"> Select SSN / EIN</label>
                            <select name="security"  class="form-control">
                                <option value="">Select</option>
                                <option value="ssn">SSN</option>
                                <option value="ein">EIN</option>
                            </select>   
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Enter SSN or EIN (Make sure you write the one selected in previous field)
                            </label>
                            <input id="birth_date" type="text" value="{{ old('security_value') }}" name="security_value"
                            placeholder="eg 232224372"  maxlength="9" class="form-control" >
                            <span style="font-size:10px">Numbers only</span>
                        </div>
                    </div>



                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputZip">street</label>
                            <input value="{{ old('street') }}" name="street"
                            placeholder="Street (ex. 1023 john Doe Ave)" class="form-control" type="text">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputZip">City</label>
                            <input placeholder="City (ex.Cleveland)" value="{{ old('city') }}" name="city" class="form-control"
                                type="text">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail3">Zip</label>
                            <input   type="number"  value="{{ old('zip') }}" name="zip"
                                class="form-control" >
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputCity">State</label>
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
                            </select>
                        </div>
                    </div>









                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputZip">Applicant Street</label>
                            <input value="{{ old('applicant_street') }}" name="applicant_street"
                            placeholder="ex. 1023 john Doe Ave" class="form-control" type="text">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputZip">Applicant City</label>
                            <input placeholder="ex.Cleveland" value="{{ old('applicant_city') }}" name="applicant_city" class="form-control"
                            placeholder="ex.Cleveland" type="text">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail3">Applicant Zip</label>
                            <input placeholder="ex.44564" type="text" value="{{ old('applicant_zip') }}" name="applicant_zip"
                                class="form-control" >
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputCity">Applicant State</label>
                            <select name="applicant_state"  class="form-control">
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
                            </select>
                        </div>
                    </div>









                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Total Income ($)</label>
                            <input  type="text" value="{{ old('total_income') }}" name="total_income" placeholder="10000.50"
                                class="form-control" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Total Expenses ($ expense should be lower than total income)</label>
                            <input  type="text" value="{{ old('total_expenses') }}" name="total_expenses"  placeholder="5000.50"
                                class="form-control" >
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
    $("#toDate").datepicker({

            dateFormat: 'yy',
            });

</script>
@endpush


