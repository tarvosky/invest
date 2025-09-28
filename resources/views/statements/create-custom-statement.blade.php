@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Add Custom Statement</h4>
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

                        <form method="POST" action="{{ route('statement.custom.store') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Business Name (optional)</label>
                                    <input type="text" value="{{ old('business_name') }}" name="business_name"
                                        class="form-control" id="inputEmail4">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Full Name</label>
                                    <input type="text" value="{{ old('full_name') }}" name="full_name"
                                        class="form-control" id="inputPassword4">
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputAddress">Address</label>
                                    <input type="text" value="{{ old('address') }}" name="address" 
                                        class="form-control">
                                </div>
                            </div>



                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputZip">Opening Balance (number only)</label>
                                    <input name="opening_balance" value="{{ old('opening_balance') }}"
                                        class="form-control" type="text">
                                </div>
                            </div>



                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputCity">City</label>
                                    <input name="city" value="{{ old('city') }}" class="form-control" type="text">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputZip">State</label>
                                    <select name="state" class="form-control">
                                       <option value=""></option>
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
                                    <label for="inputZip">Zip</label>
                                    <input value="{{ old('zip') }}" name="zip" class="form-control" type="number">
                                </div>
                            </div>



                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputCity">Currency</label>
                                    <select name="currency" id="inputState" class="form-control">
                                        <option value="dollars">Dollars</option>
                                        <option value="euros">Euros</option>
                                        <option value="pounds">Pounds</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputZip">Account / Card Number</label>
                                    <input value="{{ old('account_card_number') }}" name="account_card_number"
                                        class="form-control" type="text">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputZip">Routing</label>
                                    <input value="{{ old('routing_number') }}" name="routing_number" class="form-control"
                                        type="text">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCity">Report Date from</label>
                                    <input id="fromDate" value="{{ old('fromDate') }}" name="fromDate"
                                        class="form-control" type="text">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputZip">Report Date To</label>
                                    <input id="toDate" value="{{ old('toDate') }}" name="toDate" class="form-control"
                                        type="text">
                                </div>
                            </div>


        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputZip">Bank Name</label>
                <input name="bank_name" value="{{ old('bank_name') }}"
                    class="form-control" type="text" placeholder="e.g North Trust Bank Plc">
           </div>

            <div class="form-group col-md-4">
                <label for="inputZip">Bank Website </label>
                <input name="bank_website" value="{{ old('bank_website') }}"
                    class="form-control" placeholder="e.g www.northtrustbank.com" type="text">
           </div>

            <div class="form-group col-md-4">
                <label for="inputZip">Bank Phone</label>
                <input name="bank_phone"  placeholder="e.g 1800-222-111" value="{{ old('bank_phone') }}"
                    class="form-control" type="text">
            </div>
        </div>


        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputAddress">Bank Address</label>
                <input type="text" value="{{ old('bank_address') }}"  name="bank_address" placeholder="P.O. Box 10566"
                    class="form-control">
            </div>
        </div>


        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputZip">Bank City</label>
                <input name="bank_city" placeholder="e.g Cleveland" value="{{ old('bank_city') }}"
                    class="form-control" type="text">

           </div>

            <div class="form-group col-md-4">
                <label for="inputZip">Bank ZIP</label>
                 <input name="bank_zip" placeholder="e.g 1032" value="{{ old('bank_zip') }}"
                    class="form-control" type="number">

           </div>

            <div class="form-group col-md-4">
                <label for="inputZip">Bank State</label>
                               <select name="bank_state" class="form-control">
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
                