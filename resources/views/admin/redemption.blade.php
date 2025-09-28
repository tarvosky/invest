@extends('layouts.app_home')
@section('css')
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Orders</h4>
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
                                @if (Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif




            <div class="table-responsive">
                <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date </th>
                             <th scope="col">Ticket </th>
                            <th scope="col">Email </th>
                            <th scope="col">Amount($)</th>
                            <th scope="col">Address/Description</th>
                            <th scope="col">Status</th>
                            <th scope="col">edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key => $d)
                        <tr>
                            <td scope="row">{{$key+1}}</td>
                             <td>{{ $d->created_at->format('Y-m-d: g:i a')}}</td>
                            <td>#{{ $d->ticket}} </td>
                            <td>{{$d->users->email}} </td>
                            <td>${{ $d->amount}} </td>
                            <td>{{ $d->address}} </td>
                            <td>{{ $d->status}} </td>
                            <td>
                                <a href="{{ asset('admin/redemption/'.$d->id.'/edit')}}" data-toggle="tooltip" data-placement="bottom" title="edit"><i
                                    class="fas fa-edit text-secondary"></i></a>
                            </td>
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
                
                
                
                