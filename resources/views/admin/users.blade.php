
@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">All Users</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">


                            <h4>All Users</h4>
                            <div class="table-responsive">
                                <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Date </th>
                                            <th scope="col">Username </th>
                                            <th scope="col">Email</th>
                                            <th scope="col">IP Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $key => $d)

                                        @if($d->username =="testuser" || $d->username =="adminxxx101" )
                                        @else
                                         <tr>
                                            <td scope="row">{{$key+1}}</td>
                                            <td>{{ $d->created_at->format('Y-m-d: g:i a')}}</td>
                                            <td>{{ $d->username}} </td>
                                            <td>{{ $d->email}} </td>
                                            <td>{{ $d->ip}} </td>
                                        </tr>
                                        @endif

                                       
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



