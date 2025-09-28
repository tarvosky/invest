
@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Invoice</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">


                         
                            <div class="table-responsive">
                                <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Date </th>
                                             <th scope="col">User </th>
                                              <th scope="col">Email </th>
                                               <th scope="col">Address</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $key => $d)
                      <?php
                        if ($d->status == 0) {
                         $status = "PENDING";
                        } elseif ($d->status == 1) {
                        $status = "PENDING";
                        } elseif ($d->status == 2) {
                        $status = "PAID";
                        } elseif ($d->status == -1) {
                        $status = "UNPAID";
                        } elseif ($d->status == -2) {
                        $status = "Too little paid, please pay the rest";
                        } else {
                        $status = "Error,expired";
                        }
                        ?>

                                        <tr>
                                            <td scope="row">{{$key+1}}</td>
                                             <td>{{ $d->created_at->format('Y-m-d: g:i a')}}</td>
                                            <td>{{ $d->users->username }} </td>
                                            <td>{{ $d->users->email }} </td>
                                            <td>{{ $d->address }} </td>
                                            <td>{{ number_format($d->amount,2)}} </td>
                                            <td>{{ $status }} </td>
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



