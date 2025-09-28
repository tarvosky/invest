@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-4">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Withdraw</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                           <form method="POST" action="{{ route('payment.withdraw.post') }}">
                            @csrf
							<div class="form-group">
								<label  for="inputPassword4">Amount BTC ($) <small>(Enter Only Numbers)</small></label>
                                <input type="number" value="{{ old('amount', $amount ?? '') }}" name="amount" class="form-control" placeholder="50">
							</div>
                            <input type="hidden" name="item_name" value="Subcription">
                            <input type="hidden" name="currency" value="USD">
							<button type="submit" class="btn btn-primary">Submit</button>
						</form>

                    </div><!-- .widget-body -->
                </div><!-- .widget -->
                </div><!-- END column -->








               <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Withdrawals</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">


 <div class="table-responsive">
                                <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Date </th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $key => $d)




                                        <tr>
                                            <td scope="row">{{$key+1}}</td>
                                            <td>{{ $d->created_at->format('Y-m-d')}}</td>
                                            <td>{{ number_format($d->amount,2)}} </td>
                                            <td>{{ $d->status }} </td>
                                        </tr>
                                    @endforeach
                                   </tbody>
                                </table>
                            </div>

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



