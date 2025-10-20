@extends('layouts.app_home')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
    <style>
        video {
            width: 100%;
            height: auto;
            border-radius: 8px;
            background: #000;
        }
        .widget-body {
            padding: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        {{-- ===== Column 1 ===== --}}
        <div class="col-md-6 mb-4">
            <div class="widget">
                <header class="widget-header">
                    <h4 class="widget-title">Testimonial (too good to be true)</h4>
                </header>
                <hr class="widget-separator">
                <div class="widget-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <video class="embed-responsive-item"
                               controls
                               preload="none"
                               poster="{{ asset('images/testimonial1-thumb.jpg') }}">
                            <source src="{{ asset('video/Testimonial_1.mp4') }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== Column 2 ===== --}}
        <div class="col-md-6 mb-4">
            <div class="widget">
                <header class="widget-header">
                    <h4 class="widget-title">Testimonial (withdrawal instantly)</h4>
                </header>
                <hr class="widget-separator">
                <div class="widget-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <video class="embed-responsive-item"
                               controls
                               preload="none"
                               poster="{{ asset('images/testimonial2-thumb.jpg') }}">
                            <source src="{{ asset('video/Testimonial_2.mp4') }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div> {{-- end row --}}

    <div class="row">
        {{-- ===== Column 3 ===== --}}
        <div class="col-md-6 mb-4">
            <div class="widget">
                <header class="widget-header">
                    <h4 class="widget-title">Testimonial (within 1 month)</h4>
                </header>
                <hr class="widget-separator">
                <div class="widget-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <video class="embed-responsive-item"
                               controls
                               preload="none"
                               poster="{{ asset('images/testimonial3-thumb.jpg') }}">
                            <source src="{{ asset('video/Testimonial_3.mp4') }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div> {{-- end row --}}

    {{-- News + Banner --}}
    <div class="row">
        @include('partials/news')
    </div>

    <div class="row">
        @include('partials/banner')
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $("#issued_date, #expiry_date, #birth_date").datepicker({ dateFormat: "yy-mm-dd" });
    </script>
@endpush
