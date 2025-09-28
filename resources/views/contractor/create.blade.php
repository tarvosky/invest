@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Enter Tax Documents:1099 Contractor</h4>
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

           

                    <form method="POST" action="{{ route('contractor.store') }}">
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
                                <label for="inputEmail4">Business Name</label>
                                <input type="text" value="{{ old('employers_business_name') }}" name="employers_business_name"
                                placeholder="eg Bigwear Consultant Inc" class="form-control" id="inputEmail4">
                            </div>

        
                    </div>


                         <div class="form-row">

                               <div class="form-group col-md-6">
                                <label for="inputEmail4">Employers Phone</label>
                                <input type="text" value="{{ old('employers_phone') }}" name="employers_phone"
                                placeholder="eg 1200-322-1221" class="form-control" id="inputEmail4">
                            </div>

                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Enter Employers EIN</label>
                            <input id="birth_date" type="text" value="{{ old('employers_ein') }}" maxlength="9" name="employers_ein"
                            placeholder="eg 312432434"  class="form-control" >
                        </div>
                    </div>



                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputZip">Employers Street</label>
                            <input value="{{ old('employers_street') }}" name="employers_street"
                            placeholder="ex. 1023 john Doe Ave" class="form-control" type="text">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputZip">Employers City</label>
                            <input placeholder="ex.Cleveland" value="{{ old('employers_city') }}" name="employers_city" class="form-control"
                                type="text">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail3">Employers Zip</label>
                            <input  type="number" value="{{ old('employers_zip') }}" name="employers_zip"
                            placeholder="ex.67654" class="form-control" >
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputCity">Employers State</label>
                            <select name="employers_state"  class="form-control">
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


                    <div class="form-row col-md-12">
                        <div style="margin:20px; border:dashed 1px #EDF0F5;display:block"> </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputZip">Applicant Street</label>
                            <input value="{{ old('applicant_street') }}" name="applicant_street" type="text" 
                            placeholder="ex. 1023 john Doe Ave" class="form-control" >
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputZip">Applicant City</label>
                            <input placeholder="ex.Cleveland" value="{{ old('applicant_city') }}" name="applicant_city" class="form-control"
                            placeholder="ex.Cleveland" type="text">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail3">Applicant Zip</label>
                            <input placeholder="ex.44564" type="number" value="{{ old('applicant_zip') }}" name="applicant_zip"
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
                        <div class="form-group col-md-4">
                            <label for="inputPassword4">Applicant Fullname</label>
                            <input  type="text" value="{{ old('applicant_fullname') }}" name="applicant_fullname"
                            placeholder="John Doe" class="form-control" >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPassword4">Applicant SSN</label>
                            <input  type="text" value="{{ old('applicant_ssn') }}" name="applicant_ssn"
                            placeholder="231344356" maxlength="9"  class="form-control" >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPassword4">Applicant Total Income ($) <span style="font-size: 11px"> Enter number only</span></label>
                            <input  type="text" value="{{ old('applicant_total_income') }}" name="applicant_total_income"
                            placeholder="1000.00" class="form-control" >
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


