@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                        <?php
                        $b =  (auth()->user()->referrer_bonus == 0) ? 0: auth()->user()->referrer_bonus;
                        ?>
                            <h4 class="widget-title">Reedem Your Bonus (${{ $b }})</h4>
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
                        @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                         @endif



                        <form method="POST" action="{{ route('redeem.post.form') }}">
                            @csrf
                            
                                <div class="form-group ">
                                   <div > 
                                       <label  for="inputPassword4">Amount to Withdraw  <small > (Enter only numbers)</small> <br>
                                        <span class="text-purple">You cannot withdraw less than $50</span> <br>
                                        <span class="text-purple">Service and network charges are applicable </span>
                                </label></div>
                                    
                                        <input type="number" value="{{ old('amount') }}" name="amount" class="form-control"
                                         placeholder="e.g 50">
                                   
                         
                            </div>

                            
                                <div class="form-group ">
                                    <label  for="inputPassword4">Enter your Bitcoin address</label>
                                    <input type="text" value="{{ old('address') }}" name="address" class="form-control"
                                     placeholder="">
                                </div>
                            



                                
                                <button class="btn btn-primary" type="submit" onclick=" return confirm('Service and network charges are applicable')"    class="btn btn-secondary">Cash out now</button>
                                

                        </form>






<h2>&nbsp;</h2>
<h4>Redemption/Orders History</h4>
                        <div class="table-responsive">
                            <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Date </th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key => $d)
                                    <tr>
                                        <td scope="row">{{$key+1}}</td>
                                        <td>{{ $d->created_at->format('Y-m-d')}}</td>
                                        <td>${{ $d->amount}} </td>
                                        <td>{{ $d->address}} </td>
                                        <td>{{ $d->status}} </td>
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
                
               
                
                