
@extends('layouts.app_home')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Statement</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">

                            <div class="card-text text-capitalize">
                                <span class="text-capitalize">Business name:</span><br />
                                <span class="text-muted">{{ $statement->business_name }}</span>
                            </div>
                            <div class="card-text text-capitalize">
                                <span class="text-capitalize">full name:</span><br />
                                <span class="text-muted">{{ $statement->full_name }}</span>
                            </div>
                            <div class="card-text text-capitalize">
                                <span class="text-capitalize">Bank:</span><br />
                                <span class="text-muted">{{ $statement->bank->name }}
                                
                                @if($statement->bank->slug == "customize-any-bank")
                                : <strong>{{ $statement->bank_name }}</strong>
                                @endif
    
                                </span>
                            </div>
                            <div class="card-text text-capitalize">
                                <span class="text-capitalize">Currency:</span><br />
                                <span class="text-muted">{{ $statement->currency }}</span>
                            </div>
                            <div class="card-text text-capitalize">
                                <span class="text-capitalize">address:</span><br />
                                <span class="text-muted">{{ $statement->address }}</span>
                            </div>
                            <div class="card-text text-capitalize">
                                <span class="text-capitalize"> state / city / zip:</span><br />
                                <span class="text-muted">{{ $statement->state }} {{ $statement->city }} {{ $statement->zip }} </span>
                            </div>
                            <div class="card-text text-capitalize">
                                <span class="text-capitalize">Opening balance:</span><br />
                                <span class="text-muted">{{ $statement->opening_balance }}</span>
                            </div>
                            <div class="card-text text-capitalize">
                                <span class="text-capitalize">Acoount / Card No:</span><br />
                                <span class="text-muted">{{ $statement->account_card_number }}</span>
                            </div>
                            <div class="card-text text-capitalize">
                                <span class="text-capitalize">Routing:</span><br />
                                <span class="text-muted">{{ $statement->routing_number }}</span>
                            </div>
                            <div class="card-text text-capitalize">
                                <span class="text-capitalize">Report From Date / Report To Date:</span><br />
                                <span class="text-muted">{{ $statement->fromDate }} to {{ $statement->toDate }}</span>
                            </div>
    
                            @if($statement->bank->slug == "customize-any-bank")

    
                            <div class="card-text text-capitalize">
                                <span class="text-capitalize">Bank Name:</span><br />
                                <span class="text-muted">{{ $statement->bank_name }}
                                </span>
                            </div>
                            <div class="card-text text-capitalize">
                                <span class="text-capitalize">Bank Website:</span><br />
                                <span class="text-muted">{{ $statement->bank_website }}
                                </span>
                            </div>
                            <div class="card-text text-capitalize">
                                <span class="text-capitalize">Bank Phone:</span><br />
                                <span class="text-muted">{{ $statement->bank_phone }}
                                </span>
                            </div>      
                            <div class="card-text text-capitalize">
                                <span class="text-capitalize">Bank City / State / Zip:</span><br />
                                <span class="text-muted">{{ $statement->bank_city }} / {{ $statement->bank_state }} / {{ $statement->bank_zip }}
                                </span>
                            </div>
                            @endif  




                            <div class="py-4">

                            @if($statement->bank->slug == "customize-any-bank")
                            <a class="btn btn-warning" href="{{ asset('custom-statements/' . $statement->id . '/edit-custom-statement') }}">Edit <i
                                class="fas fa-edit"></i></a>
                            @else 
                            <a class="btn btn-warning" href="{{ asset('statements/' . $statement->id . '/edit') }}">Edit <i
                                class="fas fa-edit"></i></a>
                            @endif

                            </div>

                        </div><!-- .widget-body -->
                    </div><!-- .widget -->
                </div><!-- END column -->
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Create Transaction</h4>
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
                        <form method="POST" action="{{ url('statements/transactions/' . $statement->id) }}">
                            @csrf
                            <div class="form-group">
                                <label for="inputAddress">Date</label>
                                <input type="text" id="theDate" value="{{ old('theDate') }}" name="theDate"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Paid In (Credit) <br><small><i> Enter 0  incase of no amount,
                                           ( number
                                            only)</i></small></label>
                                <input type="text" value="{{ old('paidin') }}" name="paidin" placeholder="eg 0 or 2500.24"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Paid Out (Debit) <br><small><i>Enter 0  incase of no amount,
                                            (number
                                            only)</i></small>
                                </label>
                                <input type="text" value="{{ old('paidout') }}" name="paidout" placeholder="eg 0 or 350.99"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Description</label>
                                <input type="text" value="{{ old('description') }}"
                                    placeholder="e.g Deposit - ACH Paid From Raya K King Zelle" name="description"
                                    class="form-control">
                            </div>
                            <button type="submit" class="btn btn-secondary">Submit</button>
                        </form>
                        </div><!-- .widget-body -->
                    </div><!-- .widget -->
                </div><!-- END column -->



                <div class="col-md-6">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Transactions</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">


                            <table id="table_id" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Paid In</th>
                                        <th scope="col">Paid Out</th>
                                        <th scope="col"> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row"></th>
                                        <th></th>
                                        <th>Opening Balance</th>
                                        <th>{{ $currency . '' . number_format($statement->opening_balance,2) }}</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    @foreach ($transactions as $key => $value)
                                        <tr>
                                            <td scope="row">{{ $key + 1 }}</td>
                                            <td>{{ $value->theDate }}</td>
                                            <td>{{ $value->description }} </td>
                                            <td>{{ $value->paidin == 0 ? '' : $currency . '' . number_format($value->paidin,2) }}
                                            </td>
                                            <td> {{ $value->paidout == 0 ? '' : $currency . '' . number_format($value->paidout,2) }}
                                            </td>
                                            <td>
                                                <a href="{{ asset('statements/transactions/' . $value->id . '/edit') }}" class=""
                                                    data-toggle="tooltip" data-placement="bottom" title="edit"><i
                                                        class="fas fa-edit text-secondary"></i></a>
                                                <a href="{{ asset('statements/transactions-delete/' . $value->id) }}"
                                                    onclick="return confirm('Are you sure you want to delete this item?');"
                                                    class="" data-toggle="tooltip" data-placement="bottom" title="delete"><i
                                                        class="fas fa-trash text-danger"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach
    
                                </tbody>
                            </table>
    
                            {{-- <div style="text-align:right;"> {!! $transactions->links() !!}</div> --}}
    
                            {{-- DOWNLOAD BUTTON --}}
    
    
                            @if ($calculation['total_bal'] < 0)
                                <div class="alert alert-danger mt-3"><strong>Total
                                    </strong>{{ $currency . ' ' . $calculation['total_bal'] }} <-- total is negative
                                        recalculate to download</div>
    
                                    @else
                                        <div class="alert alert-default"><strong>Total
                                                {{ $currency . '' . number_format($calculation['total_bal']) }}</strong>
                                        </div>
                                        <div class="alert alert-warning">
                                            <strong> {{ $currency }}{{ $calendar['price'] }}</strong> (will be charged
                                            as your
                                            <strong>Order "From & To" dates</strong> selection is
                                            approx
                                            {{ $calendar['total_months'] }}month(s))
                                        </div>
                                        <div class="">
                                            <form method="POST" action="{{ url('statements/download-pdf') }}">
                                                @csrf
                                                @if ($errors->has('cost'))
                                                    <div class="alert alert-danger">{{ $errors->first('cost') }}</div>
                                                @endif
                                                @if ($errors->has('mydate'))
                                                    <div class="alert alert-danger">{{ $errors->first('mydate') }}</div>
                                                @endif
                                                @if ($errors->has('customize'))
                                                    <div class="alert alert-danger">{{ $errors->first('customize') }}
                                                    <a class="btn btn-danger" href="{{ asset('statements/' . $statement->id . '/edit') }}">Edit <i
                                        class="fas fa-edit"></i></a>
                                                    </div>
                                                @endif
                                                  @if ($errors->has('errorlogo'))
                                                    <div class="alert alert-danger">{{ $errors->first('errorlogo') }}
                                                    <a class="btn btn-danger" href="{{ asset('statements/logo/upload-logo') }}">upload logo <i
                                        class="fas fa-edit"></i></a>
                                                    </div>
                                                @endif
                                                <input type="hidden"  value="{{ $statement->id }}"
                                                    name="statement_id" />
                                                <input type="hidden" value="{{ $calendar['price'] }}" name="cost" />
                                                <button type="submit"  onclick=" return confirm('Are you sure you want to download? you will be charged $' + {{ $calendar['price']}})  " class="btn btn-lg btn-success">download now</button>
                                            </form>
    
                                        </div>
    
                            @endif
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
        $("#theDate").datepicker({
            "dateFormat": "yy-mm-dd",
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

    </script>
@endpush
