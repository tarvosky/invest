@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Enter Tax Documents:W-2 Copy C Employees</h4>
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

                <form action="{{ route('employee.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputZip">Select Year</label>
                                <select name="year"  class="form-control">
                                      <option value="{{$data->year}}">{{$data->year}}</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    {{-- <option value="2021">2021</option> --}}
                                </select> 
                            </div>
                               <div class="form-group col-md-4">
                                <label for="inputEmail4">Employers Name</label>
                                <input type="text" value="{{ $data->employers_name }}" name="employers_name"
                                placeholder="eg Richard Brandson" class="form-control" id="inputEmail4">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Employers Ein</label>
                                <input type="text" value="{{ $xein }}" name="employers_ein" maxlength="9"
                                placeholder="eg 312432434" class="form-control" id="inputEmail4">
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputZip">Employers Street</label>
                                <input value="{{ $data->employers_street }}" name="employers_street"
                                placeholder="ex. 1023 john Doe Ave" class="form-control" type="text">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputZip">Employers City</label>
                                <input placeholder="ex.Cleveland" value="{{ $data->employers_city }}" name="employers_city" class="form-control"
                                    type="text">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputEmail3">Employers Zip</label>
                                <input  type="number"  value="{{ $data->employers_zip }}" name="employers_zip"
                                placeholder="ex.67654" class="form-control" >
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputCity">Employers State</label>
                                <select name="employers_state"  class="form-control">
                                 <option value="{{$data->employers_state}}">{{$data->employers_state}}</option>
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

                        <div class="form-group col-md-4">
                            <label for="inputPassword4">Applicant Fullname</label>
                            <input  type="text" value="{{ $data->applicant_fullname }}" name="applicant_fullname"
                            placeholder="John Doe" class="form-control" >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPassword4">Applicant SSN</label>
                            <input  type="text" value="{{ $xssn }}" maxlength="9" name="applicant_ssn"
                            placeholder="231344356"  class="form-control" >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4"> Applicant Marital Status </label>
                            <select name="applicant_gender"  class="form-control">
                               <option value="{{$data->applicant_gender}}">{{$data->applicant_gender}}</option>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                            </select>   
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputZip">Applicant Street</label>
                            <input value="{{ $data->applicant_street }}" name="applicant_street"
                            placeholder="ex. 1023 john Doe Ave" class="form-control" type="text">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputZip">Applicant City</label>
                            <input placeholder="ex.Cleveland" value="{{ $data->applicant_city }}" name="applicant_city" class="form-control"
                            placeholder="ex.Cleveland" type="text">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail3">Applicant Zip</label>
                            <input placeholder="ex.44564" type="number"  value="{{ $data->applicant_zip }}" name="applicant_zip"
                                class="form-control" >
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputCity">Applicant State</label>
                            <select name="applicant_state"  class="form-control">
                             <option value="{{$data->applicant_state}}">{{$data->applicant_state}}</option>
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
                            <input  type="text" value="{{ $data->total_income }}" name="total_income"
                                placeholder="200000" class="form-control" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Income Tax ($)</label>
                            <input  type="text" value="{{ $data->income_tax }}" name="income_tax"
                            placeholder="680.34" class="form-control" >
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Social Security Wages ($)</label>
                            <input  type="text" value="{{ $data->social_security_wages }}" name="social_security_wages"
                                placeholder="2000.00" class="form-control" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Social Security Tax ($)</label>
                            <input  type="text" value="{{ $data->social_security_tax }}" name="social_security_tax"
                            placeholder="680" class="form-control" >
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Medicare Wages ($)</label>
                            <input  type="text" value="{{ $data->medicare_wages }}" name="medicare_wages"
                                placeholder="2000.00" class="form-control" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Madicare Security Tax ($)</label>
                            <input  type="text" value="{{ $data->madicare_security_tax }}" name="madicare_security_tax"
                            placeholder="680.34" class="form-control" >
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


