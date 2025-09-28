
@extends('layouts.app_home')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <header class="widget-header">
                    <h4 class="widget-title">Packages</h4>
                </header><!-- .widget-header -->
                <hr class="widget-separator">
                <div class="widget-body">



                    <div class="row">

                        @foreach ($packages as $package)
                            <div class="col-md-6 col-lg-3 mb-4">
                                <div class="widget p-md text-center h-100 d-flex flex-column justify-content-between">
                                    <div>
                                        <h4 class="widget-title">{{ $package['name'] }}</h4>
                                        <h2 class="text-primary fw-bold mb-3">${{ number_format($package['price']) }}</h2>
                                        <h6 class="text-muted mb-3">What's Included</h6>
                                        <div class="text-left mx-auto" style="max-width: 220px;">
                                            <p>• Minimum Deposit: ${{ number_format($package['price']) }}</p>
                                            <p>• ROI: {{ $package['roi'] }}</p>
                                            <p>• {{ $package['support'] }}</p>
                                            <p>• {{ $package['commission'] }}</p>
                                        </div>

                                    </div>
                                    <a href="{{ url('/payment/recharge?package=' . strtolower(explode(' ', $package['name'])[0]).'&amount='.$package['price']) }}" class="btn {{ $package['btnClass'] }} btn-block mt-3">Get Started</a>
                                </div>
                            </div>
                        @endforeach

                    </div>



                    <div class="mt-3 mb-3">
                        <a  class="btn btn-secondary " href="{{ asset('/')}}"> Back to dashboard</a>
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

@push('scripts')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
        $("#issued_date").datepicker({
            "dateFormat": "yy-mm-dd",
        });
        $("#expiry_date").datepicker({
            "dateFormat": "yy-mm-dd",
        });
        $("#birth_date").datepicker({
            "dateFormat": "yy-mm-dd",
        });

    </script>
@endpush

