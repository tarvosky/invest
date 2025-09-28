
@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">   Edit Utility</h4>
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



                 <form action="{{ route('utility.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')                       
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">First Name</label>
                                <input type="text"placeholder="John"  value="{{ $data->first_name }}" name="first_name"
                                    class="form-control" id="inputEmail4">
                            </div>
                              <div class="form-group col-md-6">
                                <label for="inputEmail4">Last Name</label>
                                <input type="text"placeholder="Doe"  value="{{ $data->last_name }}" name="last_name"
                                    class="form-control" id="inputEmail4">
                            </div>
                        </div>



                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputZip">Street</label>
                            <input value="{{ $data->street }}" name="street"
                            placeholder="ex. P.O.Box 12323 town avenue" class="form-control" type="text">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputZip">City</label>
                            <input placeholder="City (ex.Cleveland)" value="{{ $data->city }}" name="city" class="form-control"
                                type="text">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail3">Zip</label>
                            <input   type="number"  value="{{ $data->zip }}" name="zip"
                                class="form-control" >
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputCity">State</label>
                            <select name="state"  class="form-control">
                               <option value="{{$data->state}}">{{$data->state}}</option>
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

                            <div class="form-group col-md-6">
                                <label for="inputZip">Billing Date</label>
                                <input id="ein_issued_date" value="{{ $data->billing_date }}" name="billing_date" class="form-control"
                                    type="text">
                            </div>
                      <div class="form-group col-md-6">
                                <label for="inputZip">Type</label>
                               <select name="type"  class="form-control">
                                <option value="{{$data->type}}" @if ($data->type) selected="selected" @endif>{{ $array_type[$data->type]}}</option>
                                 <option value="att" @if (old('type') == 'att') selected="selected" @endif>AT&T USA</option>
                                 <option value="directv" @if (old('type') == 'directv') selected="selected" @endif>DIRECTV USA</option>
                                 <option value="spectrum" @if (old('type') == 'spectrum') selected="selected" @endif>SPECTRUM USA</option>
                                 <option value="xfinity"  @if (old('type') == 'xfinity') selected="selected" @endif>XFINITY USA</option>
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
                $("#ein_issued_date").datepicker({
            "dateFormat": "yy-mm-dd",
               changeMonth: true,
               changeYear: true,
                });
                
            </script>
        @endpush