
@extends('layouts.app_home')
@section('css')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
@endsection
@section('content')

            <div class="row">

                <div class="col-md-6">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">FAQ</h4>
                        </header><hr class="widget-separator">
                        <div class="widget-body">
                            <div class="panel-group accordion" id="accordion" role="tablist" aria-multiselectable="true">

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading-1">
                                        <a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                            <h4 class="panel-title">Tell me about {{ env('APP_NAME') }}?</h4>
                                            <i class="fa acc-switch"></i>
                                        </a>
                                    </div>
                                    <div id="collapse-1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-1">
                                        <div class="panel-body">
                                            <p>{{ env('APP_NAME') }} is a premier investment management firm specializing in diverse portfolios, focusing on high-growth opportunities across real estate, technology, and emerging markets. We provide customized strategies to maximize returns while minimizing risk for our investors like you.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading-2">
                                        <a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                                            <h4 class="panel-title">What types of investments do you offer?</h4>
                                            <i class="fa acc-switch"></i>
                                        </a>
                                    </div>
                                    <div id="collapse-2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-2">
                                        <div class="panel-body">
                                            <p>We offer a variety of investment opportunities based on the type of package you select when you signed up. You have investments that range from 20% ROI within a month to 100% ROI within a year.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading-3">
                                        <a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                                            <h4 class="panel-title">Who can invest with {{ env('APP_NAME') }}?</h4>
                                            <i class="fa acc-switch"></i>
                                        </a>
                                    </div>
                                    <div id="collapse-3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-3">
                                        <div class="panel-body">
                                            <p>We welcome both accredited and institutional investors. However, we tailor our offerings to suit individual investors, whether you're a seasoned investor or just starting, we will never breach the trust and agreement we have with you when you signed up with us.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading-4">
                                        <a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                            <h4 class="panel-title">How do I start investing with {{  env('APP_NAME')}}?</h4>
                                            <i class="fa acc-switch"></i>
                                        </a>
                                    </div>
                                    <div id="collapse-4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-4">
                                        <div class="panel-body">
                                            <p>Simply visit our website and fill out the investor sign-up form. Select the package that suits your financial goal, make payment with Bitcoin, and our team will get in touch to discuss your investment profile and guide you through the account setup and funding process.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading-5">
                                        <a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
                                            <h4 class="panel-title">What is the minimum investment required?</h4>
                                            <i class="fa acc-switch"></i>
                                        </a>
                                    </div>
                                    <div id="collapse-5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-5">
                                        <div class="panel-body">
                                            <p>Our minimum investment varies depending on the specific investment package you choose and the duration of us managing the investment for you. Typically, the minimum is $10,000, but it can be higher to $100,000 or more for specialized funds. If you want to invest more than $100,000, kindly reach out to our support on how to go about it.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading-6">
                                        <a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-6" aria-expanded="false" aria-controls="collapse-6">
                                            <h4 class="panel-title">How does {{ env('APP_NAME') }} select its investment opportunities?</h4>
                                            <i class="fa acc-switch"></i>
                                        </a>
                                    </div>
                                    <div id="collapse-6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-6">
                                        <div class="panel-body">
                                            <p>We use a rigorous due diligence process that involves financial analysis, market research, and risk assessment. Our experienced team identifies high-growth sectors and evaluates potential returns and risks to ensure alignment with investor goals.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading-7">
                                        <a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-7" aria-expanded="false" aria-controls="collapse-7">
                                            <h4 class="panel-title">What are the expected returns on investments?</h4>
                                            <i class="fa acc-switch"></i>
                                        </a>
                                    </div>
                                    <div id="collapse-7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-7">
                                        <div class="panel-body">
                                            <p>We have the stipulated Return on Investment (ROI) stated in our pricing section. Kindly visit our Pricing Page or use our Online Estimator to estimate the ROI for the package you choose.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading-8">
                                        <a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-8" aria-expanded="false" aria-controls="collapse-8">
                                            <h4 class="panel-title">What are the risks associated with investing with {{ env('APP_NAME') }}?</h4>
                                            <i class="fa acc-switch"></i>
                                        </a>
                                    </div>
                                    <div id="collapse-8" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-8">
                                        <div class="panel-body">
                                            <p>As with any investment, there are risks involved, including market volatility, liquidity risks, and sector-specific risks. We carefully manage these risks through diversification, strategic planning, and active portfolio management.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading-9">
                                        <a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-9" aria-expanded="false" aria-controls="collapse-9">
                                            <h4 class="panel-title">What payment method do you accept?</h4>
                                            <i class="fa acc-switch"></i>
                                        </a>
                                    </div>
                                    <div id="collapse-9" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-9">
                                        <div class="panel-body">
                                            <p>We accept only Bitcoin for now. Our team is working on expanding more payment options for our investors. You will be the first to know as soon as we roll out new payment and withdrawal method.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading-10">
                                        <a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-10" aria-expanded="false" aria-controls="collapse-10">
                                            <h4 class="panel-title">Can I monitor my investments online?</h4>
                                            <i class="fa acc-switch"></i>
                                        </a>
                                    </div>
                                    <div id="collapse-10" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-10">
                                        <div class="panel-body">
                                            <p>Yes, our investors have access to a secure online portal where they can monitor their portfolio performance, track returns, and view relevant financial statements and updates.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading-11">
                                        <a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-11" aria-expanded="false" aria-controls="collapse-11">
                                            <h4 class="panel-title">What fees do you charge for managing investments?</h4>
                                            <i class="fa acc-switch"></i>
                                        </a>
                                    </div>
                                    <div id="collapse-11" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-11">
                                        <div class="panel-body">
                                            <p>Our fee structure includes management fees (withdrawal charge) which are applicable to only Bronze, Silver, and Gold Packages. Due to the high volume of the Platinum Package, the withdrawal fee is waived.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading-12">
                                        <a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-12" aria-expanded="false" aria-controls="collapse-12">
                                            <h4 class="panel-title">Is there a minimum investment holding period?</h4>
                                            <i class="fa acc-switch"></i>
                                        </a>
                                    </div>
                                    <div id="collapse-12" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-12">
                                        <div class="panel-body">
                                            <p>Yes, certain investment opportunities require a holding period, typically 1 month, 3 months to 1 year, to maximize returns.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading-13">
                                        <a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-13" aria-expanded="false" aria-controls="collapse-13">
                                            <h4 class="panel-title">How frequently do you provide updates on investment performance?</h4>
                                            <i class="fa acc-switch"></i>
                                        </a>
                                    </div>
                                    <div id="collapse-13" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-13">
                                        <div class="panel-body">
                                            <p>Investors receive daily earnings updates in their portfolio summary, as well as access to real-time data through our online portal. We also send out regular updates regarding market trends and strategic decisions that may affect your investments.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading-14">
                                        <a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-14" aria-expanded="false" aria-controls="collapse-14">
                                            <h4 class="panel-title">How do you ensure transparency in your investment process?</h4>
                                            <i class="fa acc-switch"></i>
                                        </a>
                                    </div>
                                    <div id="collapse-14" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-14">
                                        <div class="panel-body">
                                            <p>Investors receive daily earnings updates in their portfolio summary, as well as access to real-time data through our online portal. We also send out regular updates regarding market trends and strategic decisions that may affect your investments.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading-15">
                                        <a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-15" aria-expanded="false" aria-controls="collapse-15">
                                            <h4 class="panel-title">What is your approach to diversification?</h4>
                                            <i class="fa acc-switch"></i>
                                        </a>
                                    </div>
                                    <div id="collapse-15" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-15">
                                        <div class="panel-body">
                                            <p>We believe in diversifying across asset classes, geographies, and sectors to reduce risk and enhance returns. Our portfolios are designed to include a mix of investments, ensuring balanced exposure to various market conditions.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading-16">
                                        <a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-16" aria-expanded="false" aria-controls="collapse-16">
                                            <h4 class="panel-title">How does {{ env('APP_NAME') }} handle market downturns?</h4>
                                            <i class="fa acc-switch"></i>
                                        </a>
                                    </div>
                                    <div id="collapse-16" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-16">
                                        <div class="panel-body">
                                            <p>During market downturns, we take a proactive approach by adjusting portfolios to minimize losses and protect capital. Our team continuously monitors market conditions and adapts investment strategies accordingly.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading-17">
                                        <a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-17" aria-expanded="false" aria-controls="collapse-17">
                                            <h4 class="panel-title">Can I invest even if I am based outside the United States?</h4>
                                            <i class="fa acc-switch"></i>
                                        </a>
                                    </div>
                                    <div id="collapse-17" class="panel-collapse collapse" role="taba" aria-labelledby="heading-17">
                                        <div class="panel-body">
                                            <p>We welcome investors from all around the world. However, we are required to collect some information about you to establish that the fund invested is from a legitimate source. We try to mitigate money laundering activity, and the Treasury Department requires we have this information available to open a portfolio account for foreigners.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading-18">
                                        <a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-18" aria-expanded="false" aria-controls="collapse-18">
                                            <h4 class="panel-title">Can I invest through my retirement account?</h4>
                                            <i class="fa acc-switch"></i>
                                        </a>
                                    </div>
                                    <div id="collapse-18" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-18">
                                        <div class="panel-body">
                                            <p>Yes, we accept investments through IRAs, 401(k)s, and other retirement accounts, where applicable. However, you will be required to convert it to Bitcoin before you can make payment into your investment portfolio. Our team can provide specific guidance on how to go about this.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading-19">
                                        <a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-19" aria-expanded="false" aria-controls="collapse-19">
                                            <h4 class="panel-title">What sets {{ env('APP_NAME') }} apart from other investment firms?</h4>
                                            <i class="fa acc-switch"></i>
                                        </a>
                                    </div>
                                    <div id="collapse-19" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-19">
                                        <div class="panel-body">
                                            <p>Our commitment to personalized service, rigorous due diligence, and innovative strategies is what sets us apart. We focus on high-growth sectors and tailor each investment to the investor's expected goal while providing ongoing support and transparency.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- END column -->




 <div class="col-md-6">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Support</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">

                    {{-- <p>Send support to <strong>support@ineedproof.cc</strong></p> --}}

                    {{-- <p>Please ensure that your 'USERNAME' in the subject </p> --}}

                    <p>Please ensure that the 'Ticket ID' which will be sent to you in your response is in the subject line so we are able to keep track of all communication.</p>

                    {{-- <p>Please note that we take your ticket very seriously hence we aim to reply you as soon as possible as each support ticket is replied to in an orderly fashion. Certain issues will require more attention than others which may result in extended response times. Please rest assured that we’re doing our very best to attend to your ticket.
                    </p> --}}
                        @if (Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{{ Session::get('success') }}</li>
                            </ul>
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

                        <form method="POST" action="{{ route('home.post.support') }}">
                            @csrf
                            <div class="form-group">
                                    <label for="inputPassword4">Subject</label>
                                    <input type="text" value="{{ old('subject') }}" name="subject" class="form-control"
                                        id="inputPassword4">
                                        <input type="hidden" name="username" value={{ auth()->user()->username}} />
                                        <input type="hidden" name="email" value="{{ auth()->user()->email}}" />

                            </div>
                            <div class="form-group">
                                    <textarea name="message" id="" class="form-control" cols="30" rows="10">{{ old('message') }}</textarea>

                            </div>


                    <button type="submit" class="btn btn-secondary">Submit</button>
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

@push('scripts')
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>
<script type="text/javascript">
    $('#reload').click(function () {

        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });

</script>

@endpush
@endsection




