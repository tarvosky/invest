
@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">   CREATE LATE RENT</h4>
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


                    <form method="POST" action="{{ route('rental.post.lr') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">First Name</label>
                                <input type="text"placeholder="John "  value="{{ old('first_name') }}" name="first_name"
                                    class="form-control" id="inputEmail4">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Last Name</label>
                                <input type="text"placeholder="Foster"  value="{{ old('last_name') }}" name="last_name"
                                    class="form-control" id="inputEmail4">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Landlord First Name</label>
                                <input type="text"placeholder="John "  value="{{ old('landlord_first_name') }}" name="landlord_first_name"
                                    class="form-control" id="inputEmail4">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Landlord Last Name</label>
                                <input type="text"placeholder="Foster"  value="{{ old('landlord_last_name') }}" name="landlord_last_name"
                                    class="form-control" id="inputEmail4">
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Bank Name</label>
                                <input type="text"placeholder="Chase Bank"  value="{{ old('bank_name') }}" name="bank_name"
                                    class="form-control" id="inputEmail4">
                            </div>                           
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Account Number</label>
                                <input type="text"placeholder="102939892221"  value="{{ old('account_number') }}" name="account_number"
                                    class="form-control" id="inputEmail4">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Routing Number</label>
                                <input type="text"placeholder="232322"  value="{{ old('routing_number') }}" name="routing_number"
                                    class="form-control" id="inputEmail4">
                            </div>
                        </div>


                        <div class="form-row">
 
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">Rent Amount</label>
                                <input id="rent_fee" placeholder="2600.00"  value="{{ old('rent_fee') }}" name="rent_fee" class="form-control"
                                    type="text">
                            </div>

                           <div class="form-group col-md-3">
                                <label for="inputZip">Late Fees</label>
                                <input  placeholder="50.00"  value="{{ old('late_fee') }}" name="late_fee" class="form-control"
                                    type="text">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputZip">Months Late in Rent (number only)</label>
                                <input  placeholder="e.g 8" maxlength="2"  value="{{ old('month') }}" name="month" class="form-control"
                                    type="text">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputEmail4">Date on Form</label>
                                <input id="form_date" value="{{ old('form_date') }}" name="form_date" class="form-control"
                                    type="text">
                            </div>
                        </div>



                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputZip">Street</label>
                            <input value="{{ old('street') }}" name="street"
                            placeholder="ex.  12323 town avenue" class="form-control" type="text">
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
                $("#vacating_date").datepicker({
            "dateFormat": "yy-mm-dd",
               changeMonth: true,
               changeYear: true,
                });
                
                $("#form_date").datepicker({
            "dateFormat": "yy-mm-dd",
               changeMonth: true,
               changeYear: true,
                });
            </script>
        @endpush