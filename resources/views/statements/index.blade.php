@extends('layouts.app_home')
@section('content')




            <div class="row">
                <div class="col-md-12">
                    <div class="widget">

                        <header class="widget-header">
                            <h4 class="widget-title">Bank Statements</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">


                        <div class="alert alert-info" style="margin:15px" >
                            <p>Available Statements: click & slide to view demo</p> 
                            <p> 
                            <a href="{{ asset('watermark/BOA_Page_1.png') }}" data-lightbox="gallery-1" data-title="BOA PAGE 1">BOA</a>
                            <a href="{{ asset('watermark/BOA_Page_2.png') }}" data-lightbox="gallery-1" data-title="BOA PAGE 2"></a>
                            <a href="{{ asset('watermark/BOA_Page_3.png') }}" data-lightbox="gallery-1" data-title="BOA PAGE 3"></a> / 

                            <a href="{{ asset('watermark/BBT_Page_1.png') }}" data-lightbox="gallery-1" data-title="BBT PAGE 1">BBT</a> 
                            <a href="{{ asset('watermark/BBT_Page_2.png') }}" data-lightbox="gallery-1" data-title="BBT PAGE 2"></a>
                            <a href="{{ asset('watermark/BBT_Page_3.png') }}" data-lightbox="gallery-1" data-title="BBT PAGE 3"></a>  /
                             
                             <a href="{{ asset('watermark/BBVA_Page_1.png') }}" data-lightbox="gallery-1" data-title="BBVA PAGE 1">BBVA</a> 
                             <a href="{{ asset('watermark/BBVA_Page_2.png') }}" data-lightbox="gallery-1" data-title="BBVA PAGE 2"></a> 
                             <a href="{{ asset('watermark/BBVA_Page_3.png') }}" data-lightbox="gallery-1" data-title="BBVA PAGE 3"></a> /
                             
                             
                            <a href="{{ asset('watermark/CHASE_Page_1.png') }}" data-lightbox="gallery-1" data-title="CHASE PAGE 1"> CHASE</a> 
                            <a href="{{ asset('watermark/CHASE_Page_2.png') }}" data-lightbox="gallery-1" data-title="CHASE PAGE 2"> </a> 
                            <a href="{{ asset('watermark/CHASE_Page_3.png') }}" data-lightbox="gallery-1" data-title="CHASE PAGE 3"> </a> /

                            <a href="{{ asset('watermark/CAPITAL_Page_1.png') }}" data-lightbox="gallery-1" data-title="CAPITAL ONE PAGE 1">CAPITAL ONE</a> 
                            <a href="{{ asset('watermark/CAPITAL_Page_2.png') }}" data-lightbox="gallery-1" data-title="CAPITAL ONE PAGE 2"></a> 
                            <a href="{{ asset('watermark/CAPITAL_Page_3.png') }}" data-lightbox="gallery-1" data-title="CAPITAL ONE PAGE 3"></a> 
                            <a href="{{ asset('watermark/CAPITAL_Page_4.png') }}" data-lightbox="gallery-1" data-title="CAPITAL ONE PAGE 4"></a> /

                            <a href="{{ asset('watermark/NFCU_Page_1.png') }}" data-lightbox="gallery-1" data-title="NFCU PAGE 1">NAVY FEDERAL CREDIT </a> 
                            <a href="{{ asset('watermark/NFCU_Page_2.png') }}" data-lightbox="gallery-1" data-title="NFCU PAGE 2"></a> 
                            <a href="{{ asset('watermark/NFCU_Page_3.png') }}" data-lightbox="gallery-1" data-title="NFCU PAGE 3"> </a> 
                            <a href="{{ asset('watermark/NFCU_Page_4.png') }}" data-lightbox="gallery-1" data-title="NFCU PAGE 4"> </a> /


                            <a href="{{ asset('watermark/REGIONS_Page_1.png') }}" data-lightbox="gallery-1" data-title="REGIONS Page 1">REGIONS</a> 
                            <a href="{{ asset('watermark/REGIONS_Page_2.png') }}" data-lightbox="gallery-1" data-title="REGIONS Page 2"></a> 
                            <a href="{{ asset('watermark/REGIONS_Page_3.png') }}" data-lightbox="gallery-1" data-title="REGIONS Page 3"></a> /

            
                            <a href="{{ asset('watermark/Suntrust_Page_1.png') }}" data-lightbox="gallery-1" data-title="SUNTRUST PAGE 1">SUN TRUST</a> 
                            <a href="{{ asset('watermark/Suntrust_Page_2.png') }}" data-lightbox="gallery-1" data-title="SUNTRUST PAGE 2"></a> /


                            <a href="{{ asset('watermark/TD_Page_1.png') }}" data-lightbox="gallery-1" data-title="TD BANK 1">TD-BANK </a>
                            <a href="{{ asset('watermark/TD_Page_2.png') }}" data-lightbox="gallery-1" data-title="TD BANK 2">
                            <a href="{{ asset('watermark/TD_Page_3.png') }}" data-lightbox="gallery-1" data-title="TD BANK 3">
                            <a href="{{ asset('watermark/TD_Page_4.png') }}" data-lightbox="gallery-1" data-title="TD BANK 4"></a> /


                            <a href="{{ asset('watermark/USBANK_Page_1.png') }}" data-lightbox="gallery-1" data-title="USBANK Page 1">US-BANK</a> 
                            <a href="{{ asset('watermark/USBANK_Page_2.png') }}" data-lightbox="gallery-1" data-title="USBANK Page 2"></a> 
                            <a href="{{ asset('watermark/USBANK_Page_3.png') }}" data-lightbox="gallery-1" data-title="USBANK Page 3"></a> /



                            <a href="{{ asset('watermark/WELLS_Page_1.png') }}" data-lightbox="gallery-1" data-title="WELLS Page 1">WELLS-FARGO</a> 
                            <a href="{{ asset('watermark/WELLS_Page_2.png') }}" data-lightbox="gallery-1" data-title="WELLS Page 2"></a> 
                            <a href="{{ asset('watermark/WELLS_Page_3.png') }}" data-lightbox="gallery-1" data-title="WELLS Page 3"></a> 
                            <a href="{{ asset('watermark/WELLS_Page_4.png') }}" data-lightbox="gallery-1" data-title="WELLS Page 4"></a> / 
                            </p>
                            <p>View <a href="{{ asset('home/how-it-works')}}">Video</a></p>
                           <p>Price : $10/ month</p>
                           
                          
                        </div>






                        <div class="widget-body">


                        @if (Session::has('message'))
                        <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif


                            <div class="table-responsive">
                                <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Date </th>
                                            <th scope="col">Business Name</th>
                                            <th scope="col">Full name</th>
                                            <th scope="col">Bank</th>
                                            <th scope="col"> <a class="btn btn-primary float-right" data-toggle="tooltip"
                                                    data-placement="bottom" title="new order"
                                                    href="{{ asset('statements/create') }}"> Place Order <i class="fas fa-plus"></i></a> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $value)
                                        <tr>
                                            <td scope="row">{{ $key + 1 }}</td>
                                            <td>{{ $value->created_at->format('y-m-d') }}</td>
                                            <td>{{ $value->business_name }}</td>
                                            <td>{{ $value->full_name }}</td>
                                            <td>{{ $value->bank->slug }}</td>
                                            <td><a href="{{ asset('statements/' . $value->id . '/edit') }}"
                                                    data-toggle="tooltip" data-placement="bottom" title="edit"><i
                                                        class="fas fa-edit text-secondary"></i></a>
    
    
                                                <a href="{{ asset('statements/' . $value->id . '/delete') }}"
                                                    onclick="return confirm('Are you sure you want to delete this item?');"
                                                    class="" data-toggle="tooltip" data-placement="bottom" title="delete"><i
                                                        class="fas fa-trash text-danger"></i> </a>
    
    
    
                                                <a href="{{ asset('statements/transactions/' . $value->id) }}"
                                                    data-toggle="tooltip" data-placement="bottom"
                                                    title="add transactions / preview / download"> <i
                                                        class="fas fa-download text-success"></i></a>
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