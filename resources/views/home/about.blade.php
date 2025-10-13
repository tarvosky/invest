
@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">




    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">About {{ config('app.name') }}</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
     <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="{{asset('video/ceo.mp4')}}"></iframe>
      </div>

</div><!-- .widget-body -->

                    <div class="widget-body">
                    <p>
                        Founded in 2022 by Helen Decker, and recently started its online presence. {{ config('app.name') }} has built a legacy of providing high value returns for our investors. With years of combined experience in the investment industry, our team of financial analysts, business strategists, and risk management experts work together to identify businesses that are poised for growth.
                        We specialize in pooling investor funds to capitalize on high-performing ventures, while maintaining a keen eye on risk mitigation and long-term sustainability.
                    </p>
                    <p> Our core values include: </p>
                    <ul>
                        <li>Integrity: We uphold transparency and honesty in all dealings.</li>
                        <li>Expertise: Our team brings a wealth of knowledge and experience to every investment decision.</li>
                        <li>Growth: Our focus is on helping investors achieve their financial goals with measurable results.</li>
                    </ul>
                    </p>
                </div>
                    </div>
                </div>
            </div><!-- .row -->



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

