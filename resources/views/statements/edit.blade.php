<?php $state_arr = [
'AL' => 'Alabama',
'AK' => 'Alaska',
'AZ' => 'Arizona',
'AR' => 'Arkansas',
'CA' => 'California',
'CO' => 'Colorado',
'CT' => 'Connecticut',
'DE' => 'Delaware',
'DC' => 'District of Columbia',
'FL' => 'Florida',
'GA' => 'Georgia',
'HI' => 'Hawaii',
'ID' => 'Idaho',
'IL' => 'Illinois',
'IN' => 'Indiana',
'IA' => 'Iowa',
'KS' => 'Kansas',
'KY' => 'Kentucky',
'LA' => 'Louisiana',
'ME' => 'Maine',
'MD' => 'Maryland',
'MA' => 'Massachusetts',
'MI' => 'Michigan',
'MN' => 'Minnesota',
'MS' => 'Mississippi',
'MO' => 'Missouri',
'MT' => 'Montana',
'NE' => 'Nebraska',
'NV' => 'Nevada',
'NH' => 'New Hampshire',
'NJ' => 'New Jersey',
'NM' => 'New Mexico',
'NY' => 'New York',
'NC' => 'North Carolina',
'ND' => 'North Dakota',
'OH' => 'Ohio',
'OK' => 'Oklahoma',
'OR' => 'Oregon',
'PA' => 'Pennsylvania',
'RI' => 'Rhode Island',
'SC' => 'South Carolina',
'SD' => 'South Dakota',
'TN' => 'Tennessee',
'TX' => 'Texas',
'UT' => 'Utah',
'VT' => 'Vermont',
'VA' => 'Virginia',
'WA' => 'Washington',
'WV' => 'West Virginia',
'WI' => 'Wisconsin',
'WY' => 'Wyoming',
]; ?>



@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Edit Statement</h4>
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

                        <form action="{{ route('statements.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Business Name</label>
                                    <input type="text" value="{{ $data->business_name }}" name="business_name"
                                        class="form-control" id="inputEmail4">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Full Name</label>
                                    <input type="text" value="{{ $data->full_name }}" name="full_name"
                                        class="form-control" id="inputPassword4">
                                </div>
                            </div>
                            <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Address</label>
                                <input type="text" value="{{ $data->address }}" name="address" name="address"
                                    class="form-control">
                            </div>
                        </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputAddress">Bank</label>
                                    <select name="bank_id" id="inputState" class="form-control">
                                        @foreach ($banks as $bank)
                                            <option @if ($data->bank_id === $bank->id) selected @endif value={{ $bank->id }}>
                                                {{ $bank->name }}</option>
                                        @endforeach
                                    </select>
                             
                                </div>

                             




                                <div class="form-group col-md-6">
                                    <label for="inputZip">Opening Balance (number only)</label>
                                    <input name="opening_balance" value="{{ $data->opening_balance }}"
                                        class="form-control" type="text">
                                </div>
                            </div>









                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputCity">City</label>
                                    <input name="city" value="{{ $data->city }}" class="form-control" type="text">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputZip">State</label>






                                    <select name="state" class="form-control">
                                        <option value="<?php echo $data->state; ?>"><?php echo $state_arr[$data->state]; ?></option>
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
                                    <input value="{{ $data->zip }}" name="zip" class="form-control" type="number">
                                </div>
                            </div>



                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputCity">Currency</label>
                                    <select name="currency" id="inputState" class="form-control">
                                        <option value="{{ $data->currency }}">{{ $data->currency }}</option>
                                        <option value="dollars">Dollars</option>
                                        <option value="euros">Euros</option>
                                        <option value="pounds">Pounds</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputZip">Account / Card Number</label>
                                    <input value="{{ $data->account_card_number }}" name="account_card_number"
                                        class="form-control" type="text">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputZip">Routing</label>
                                    <input name="routing_number" value="{{ $data->routing_number }}" class="form-control"
                                        type="text">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCity">Report Date from</label>
                                    <input id="fromDate" value="{{ $data->fromDate }}" name="fromDate"
                                        class="form-control" type="text">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputZip">Report Date To</label>
                                    <input id="toDate" value="{{ $data->toDate }}" name="toDate" class="form-control"
                                        type="text">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
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
                