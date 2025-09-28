@extends('layouts.app_home')
@section('css')
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Announcement</h4>
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





        <form action="{{ route('admin.redemption.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
                <div class="form-row">

                    <div class="form-group col-md-12">
     

                                    <table class="table">
                                        <tr>
                                            <td>NAME:</td>
                                            <td>{{ $data->users->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>USERNAME:</td>
                                            <td>{{ $data->users->username }}</td>
                                        </tr>
                                        <tr>
                                            <td>EMAIL:</td>
                                            <td>{{ $data->users->email }}</td>
                                        </tr>    
                                        <tr>
                                            <td>AMOUNT TO PAY: </td>
                                            <td>${{ $data->amount}}</td>
                                        </tr>
                                        <tr>
                                            <td>ADDRESS/DESCRIPTION: </td>
                                            <td>{{ $data->address}}</td>
                                        </tr>
                                    </table>



                </div>

                </div>

           
            <div class="form-row">

                <div class="form-group col-md-12">
                    <label for="inputEmail4">Status</label>
                    <select  name="status" class="form-control" >
                        <option value="{{$data->status}}">{{$data->status}}</option>
                        <option value="pending">pending</option>
                        <option value="completed">completed</option>
                        <option value="cancelled">Cancelled</option>
                      </select>
                      <input type="hidden" name="ticket" value="{{ $data->ticket}}" />
                      <input type="hidden" name="order_slug" value="{{ $data->order_slug}}" />
                      <input type="hidden" name="username" value="{{ $data->users->username }}" />
                      <input type="hidden" name="email" value="{{ $data->users->email }}" />
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
                
                
                
                