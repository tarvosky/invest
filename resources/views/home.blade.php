
@extends('layouts.app_home')
@section('css')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
@endsection
@section('content')
<div class="row">




    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold text-uppercase"> {{  auth()->user()->name."'s " ?? "john Doe" }} Portfolio</h2>
        </div>
    </div>

    <div class="row mb-4">

        <!-- Total Deposit -->
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="widget p-md stats-widget">
                <div class="widget-body clearfix">
                    <div class="pull-left">
                        <h4 class="widget-title">Total Deposit</h4>
                        <h2 class="text-primary fw-bold">$ {{ number_format($initialDeposit,2) }}</h2>
                    </div>
                    <span class="pull-right big-icon watermark"><i class="fa fa-wallet"></i></span>
                </div>
            </div>
        </div>
        <!-- Current Account Value -->
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="widget p-md stats-widget">
                <div class="widget-body clearfix">
                    <div class="pull-left">
                        <h4 class="widget-title">Current Daily Incurred</h4>
                        <h2 class="text-success fw-bold">${{ number_format($dailyIncurred,2) }}</h2>
                    </div>
                    <span class="pull-right big-icon watermark"><i class="fa fa-chart-line"></i></span>
                </div>
            </div>
        </div>

        <!-- Total Earnings -->
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="widget p-md stats-widget">
                <div class="widget-body clearfix">
                    <div class="pull-left">
                        <h4 class="widget-title">Total Earnings</h4>
                        <h2 class="text-warning fw-bold">${{ number_format($totalCapital,2) }}</h2>
                    </div>
                    <span class="pull-right big-icon watermark"><i class="fa fa-coins"></i></span>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <!-- Dashboard Card (70%) -->
        <div class="col-md-8 col-sm-12">
            <div class="widget widget-pie-chart">
                <header class="widget-header">
                    <h4 class="widget-title">{{ __('Crypto Market Overview') }}</h4>
                </header>
                <div class="widget-body">
                    {{-- Crypto Prices Table --}}
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead>
                            <tr>
                                <th style="width:10%">Symbol</th>
                                <th style="width:20%">Name</th>
                                <th style="width:20%">Price (USD)</th>
                                <th style="width:20%">24h Change (%)</th>
                                <th style="width:20%">7d Trend</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($cryptoData as $coin)
                                <tr>
                                    <td>{{ $coin['symbol'] }}</td>
                                    <td>{{ $coin['name'] }}</td>
                                    <td>${{ number_format($coin['quote']['USD']['price'], 2) }}</td>
                                    <td class="{{ $coin['quote']['USD']['percent_change_24h'] >= 0 ? 'text-success' : 'text-danger' }}">
                                        {{ number_format($coin['quote']['USD']['percent_change_24h'], 2) }}%
                                    </td>
                                    <td>
                                        <canvas id="chart-{{ $coin['id'] }}" height="40"></canvas>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Unable to fetch crypto data at this time.</td>
                                </tr>
                            @endforelse
                            </tbody>

                        </table>
                    </div>


                </div>

            </div>
        </div>

        <!-- Form Card (30%) -->
        <div class="col-md-4 col-sm-12">


            <div class="widget p-md clearfix">
                <div class="pull-left">
                    <h3 class="widget-title">Recharge</h3>
                    <a class="btn btn-primary" href="{{ asset('payment/recharge')}}">Update Balance Now</a>
                </div>
                <span class="pull-right fz-lg fw-500 "></span>
            </div><!-- .widget -->


            <div class="widget p-md clearfix">
                <h4 class="widget-title mb-3">Investment Form</h4>
                <form method="POST" action="#">
                    @csrf
                    <div class="form-group">
                        <label for="amount">Amount ($)</label>
                        <input type="number" name="amount" class="form-control" placeholder="Enter amount" required>
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <select name="duration" class="form-control" required>
                            <option value="" disabled selected>Select duration</option>
                            <option value="1_month">1 Month</option>
                            <option value="3_months">3 Months</option>
                            <option value="6_months">6 Months</option>
                            <option value="12_months">12 Months</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-3">Submit</button>
                </form>
            </div>



        </div>
    </div>


    <div class="col-md-12 col-sm-12">
        <div class="widget p-md">
            <h4 class="widget-title mb-3">Recent Transactions</h4>

    <div class="table-responsive">
        <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Date </th>
                <th scope="col">Description</th>
                <th scope="col">Balance</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $key => $d)
                <tr>
                    <td scope="row">{{$key+1}}</td>
                    <td>{{ $d->created_at->format('Y-m-d')}}</td>
                    <td>{{ $d->description}} </td>
                    <td>${{ number_format($d->balance,2)}} </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
        </div>
    </div>



{{--    			<div class="col-md-6 col-sm-6">--}}
{{--				<div class="widget p-md clearfix">--}}
{{--					<div class="pull-left">--}}
{{--						<h3 class="widget-title">Welcome to {{ env('APP_NAME') }}</h3>--}}
{{--						<a class="btn btn-primary" href="{{ asset('payment/recharge')}}">Recharge Wallet Now</a>--}}
{{--					</div>--}}
{{--					<span class="pull-right fz-lg fw-500 "></span>--}}
{{--				</div><!-- .widget -->--}}
{{--			</div>--}}



{{--			<div class="col-md-6 col-sm-6">--}}
{{--      	<div class="widget p-md">--}}
{{--				<div class=" clearfix">--}}
{{--					<span class="pull-left">--}}
{{--						<h3 class="widget-title">Referral Bonus</h3>--}}

{{--					</span>--}}
{{--					<span class="pull-right fz-lg fw-500 " >${{ $bonus}}</span>--}}
{{--        </div>--}}



{{--             <table class="table table-responsive" width="100%">--}}
{{--             <tr>--}}
{{--               <td width="50%">--}}

{{--                    @if (session('success'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('success') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                      <form method="POST" action="{{route('addToWalletFromRef.post')}}">--}}
{{--                      @csrf--}}
{{--                  <div class="form-group">--}}
{{--								<label  for="inputPassword4">Amount ($) <small>(Enter Only Numbers)</small></label>--}}
{{--                 <input type="text"  name="referrer_bonus" class="form-control" placeholder="50">--}}
{{--                 <small class="text-danger">{{ $errors->first('referrer_bonus') }}</small>--}}
{{--                  </div>--}}
{{--                      <button onclick="return confirm('Are you sure you want to transfer to your wallet?');" class="btn btn-primary btn-block" type="submit">Add to In-store Wallet</button>--}}
{{--                      </form>--}}
{{--               </td>--}}
{{--                <td width="50%">--}}
{{--                	<p>Click on this option to transfer your bonus to external BTC wallet</p>--}}
{{--                     <div style="margin-top:37px"> <a class="btn btn-success btn-block" href="{{ asset('payment/redeem')}}">Cash Out</a></div>--}}
{{--                </td>--}}
{{--             </tr>--}}
{{--             </table>--}}







{{--				</div><!-- .widget -->--}}

{{--			</div>--}}
{{--</div><!-- .row -->--}}



@if(auth()->user()->role == "admin")
<div class="row">
  <div class="col-md-6 col-sm-6">
    <div class="widget stats-widget">
      <div class="widget-body clearfix">
        <div class="pull-left">
          <h3 class="widget-title text-primary">$<span class="counter" data-plugin="counterUp">{{ number_format($ref_bonus,2)}}</span></h3>
          <small class="text-color">Total Referral Bonus</small>
        </div>
        <span class="pull-right big-icon watermark"><i class="fa fa-paperclip"></i></span>
      </div>
    </div><!-- .widget -->
  </div>



  {{-- <div class="col-md-3 col-sm-6">
    <div class="widget stats-widget">
      <div class="widget-body clearfix">
        <div class="pull-left">
          <h3 class="widget-title text-success"><span class="counter" data-plugin="counterUp">0.209</span>k</h3>
          <small class="text-color">Case Close</small>
        </div>
        <span class="pull-right big-icon watermark"><i class="fa fa-unlock-alt"></i></span>
      </div>

    </div><!-- .widget -->
  </div>

  <div class="col-md-3 col-sm-6">
    <div class="widget stats-widget">
      <div class="widget-body clearfix">
        <div class="pull-left">
          <h3 class="widget-title text-warning"><span class="counter" data-plugin="counterUp">3.490</span>k</h3>
          <small class="text-color">Total Pending</small>
        </div>
        <span class="pull-right big-icon watermark"><i class="fa fa-file-text-o"></i></span>
      </div>

    </div><!-- .widget -->
  </div> --}}

  <div class="col-md-6 col-sm-6">
    <div class="widget stats-widget">
      <div class="widget-body clearfix">
        <div class="pull-left">
          <h3 class="widget-title ">SMS Balance</h3>






              <p id="loading_balance" style="display:none;margin-top:5px" class="m-2"> <i class="fas fa-spinner fa-pulse fa-2x"></i></p>

              <a class="btn btn-success" onclick="getBalance()" > Check SMS Balance</a>

        </div>
        <span class="pull-right ">$<span style="font-size:18px;padding:10px;color:'brown';"  id="mybalance"></span> </span>
      </div>

    </div><!-- .widget -->
  </div>


</div>
@endif











{{--		<div class="row">--}}
{{--			<div class="col-md-12">--}}
{{--				<div class="widget widget-pie-chart">--}}
{{--					<header class="widget-header">--}}
{{--						<h4 class="widget-title">{{ __('Dashboard') }}</h4>--}}
{{--					</header>--}}
{{--          --}}{{-- <hr class="widget-separator"> --}}
{{--          <div class="widget-body">--}}

{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    @if (session('error'))--}}
{{--                        <div class="alert alert-danger" role="alert">--}}
{{--                            {{ session('error') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}


{{--                    <table class="table">--}}
{{--                      <tr>--}}
{{--                        <td><strong>Username:</strong></td>--}}
{{--                        <td>{{ Auth::user()->username }}</td>--}}
{{--                      </tr>--}}
{{--                      <tr>--}}
{{--                        <td><strong>Email:</strong></td>--}}
{{--                        <td>{{ Auth::user()->email }}</td>--}}
{{--                      </tr>--}}
{{--                      <tr>--}}
{{--                        <td><strong>Referral link:</strong></td>--}}
{{--                        <td><a target="_blank" href="{{ Auth::user()->referral_link }}">{{ Auth::user()->referral_link }}</a></td>--}}
{{--                      </tr>--}}
{{--                      <tr>--}}
{{--                        <td><strong>Referrer:</strong></td>--}}
{{--                        <td>{{ Auth::user()->referrer->name ?? 'Not Specified' }}</td>--}}
{{--                      </tr>--}}
{{--                      <tr>--}}
{{--                        <td><strong>Referral count:</strong></td>--}}
{{--                        <td> {{ count(Auth::user()->referrals)  ?? '0' }}</td>--}}
{{--                      </tr>--}}
{{--                    </table>--}}
{{--              </div>--}}
{{--					</div>--}}
{{--				</div><!-- .widget -->--}}
{{--			</div>--}}









{{--   <div class="row">--}}
{{--		   @include('partials/news')--}}
{{--   </div><!-- .row -->--}}


{{--   <div class="row">--}}
{{--    @include('partials/banner')--}}
{{--   </div><!-- .row -->--}}












@endsection


  @push('scripts')

  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
  </script>
<script>
  localStorage.clear("count_timer");




                // GET BALANCE
                function getBalance() {

                        document.getElementById("loading_balance").style.display = "inline-block";
                        //document.getElementById("hidecopy_request").style.display = "none";
                        let  url = "<?php echo env('APP_URL'); ?>"
                        let  url_link = url + '/sms-ajax/get-balance';
                         $.ajax({
                           type: "GET",
                           url:url_link,
                           success: function (data) {
                               document.getElementById("loading_balance").style.display = "none";
                               console.log(data);
                               console.log('balance');
                               // send to db
                               let num = data.data;
                             $("#mybalance").html(num);
                           },
                             error: function (data) {
                                 document.getElementById("loading_balance").style.display = "none";
                                 console.log(data);
                             var errors = $.parseJSON(data.responseText);
                             console.log(errors);
                             console.log('error');
                             }
                         });


                }
  </script>


        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                @foreach($cryptoData as $coin)
                var ctx = document.getElementById("chart-{{ $coin['id'] }}").getContext("2d");
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ["7d", "6d", "5d", "4d", "3d", "2d", "1d"], // dummy labels
                        datasets: [{
                            label: "{{ $coin['symbol'] }} Trend",
                            data: [
                                {{ $coin['quote']['USD']['percent_change_7d'] }},
                                {{ $coin['quote']['USD']['percent_change_24h'] }},
                                {{ $coin['quote']['USD']['percent_change_1h'] ?? 0 }},
                                0, 1, -1, 2 // fallback dummy values
                            ],
                            borderColor: "{{ $coin['quote']['USD']['percent_change_24h'] >= 0 ? '#28a745' : '#dc3545' }}",
                            backgroundColor: "transparent",
                            tension: 0.4,
                            pointRadius: 0
                        }]
                    },
                    options: {
                        plugins: { legend: { display: false }},
                        scales: { x: { display: false }, y: { display: false }},
                    }
                });
                @endforeach
            });
        </script>
@endpush
