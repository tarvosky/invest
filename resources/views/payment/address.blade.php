@extends('layouts.app_home')

@php
    $statusval = $data->status ?? -99; // fallback
    $status = $data->status ?? -99;
    $btc = $btc ?? 0;
@endphp

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/jquery.countdown.css') }}">

    <style>

        #btcAmount, #usdAmount, #btcAddress {
            font-family: monospace;
            text-align: center;
            font-size: 1.1rem;
        }

        .copy-btn, .btn-primary {
            min-width: 80px;
            font-weight: 500;
        }

        .alert label {
            color: #444;
            font-size: 0.9rem;
        }


        .copy-btn {
            min-width: 90px;
            font-weight: 600;
        }

        .input-group-text {
            border-left: none;
            border-right: none;
        }

        .alert label {
            font-size: 0.9rem;
            color: #555;
        }


        /* General card styling */
        .wallet-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .wallet-card h4, .wallet-card h5 {
            margin-bottom: 15px;
        }

        /* Countdown timer */
        #total-time-left {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* QR code styling */
        .qr-hold img {
            max-width: 100%;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        /* Address input styling */
        #btcAddress {
            font-family: monospace;
            text-align: center;
        }

        .copy-btn {
            min-width: 80px;
        }

        .alert-custom {
            background-color: #f9f9f9;
            color: #333;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }
    </style>
@endsection

@section('content')
    <div class="row justify-content-center">

        {{-- Payment Column --}}
        <div class="col-md-6 mb-4">
            <div class="wallet-card text-center">
                <h4>Subscription Payment</h4>

                <p>Please send the exact amount of BTC to the address below</p>

                {{-- BTC Amount with Copy --}}
                <div class="alert alert-secondary p-3 mb-3 text-start">
                    <label for="btcAmount" class="fw-semibold text-uppercase d-block mb-2"
                           style="letter-spacing:0.5px;">Bitcoin Amount</label>
                    <div style="display:flex; width:100%; gap:10px; align-items: stretch;">
                        <input type="text" id="btcAmount" class="form-control text-center" value="{{ $btc }}" readonly
                               style="flex:1;">
                        <button type="button" class="btn btn-default" onclick="copyBTC()" style="flex:0 0 auto;">Copy
                        </button>
                    </div>
                </div>

                {{-- USD Equivalent --}}
                <div class="alert alert-secondary p-3 mb-3 text-start">
                    <label for="usdAmount" class="fw-semibold text-uppercase d-block mb-2"
                           style="letter-spacing:0.5px;">USD Equivalent</label>
                    <div style="display:flex; width:100%; gap:10px; align-items: stretch;">
                        <input type="text" id="usdAmount" class="form-control text-center"
                               value="${{ $data->amount ?? '0.00' }}" readonly style="flex:1;">
                        {{--                        <button type="button" class="btn btn-default" onclick="copyUSD()" style="flex:0 0 auto;">Copy</button>--}}
                    </div>
                </div>


                {{-- BTC Address with Copy --}}
                <div class="alert alert-light p-3 mb-3">
                    <label class="d-block mb-1 fw-semibold text-uppercase" style="letter-spacing:0.5px;">Wallet
                        Address</label>
                    <div style="display:flex; width:100%; gap:10px; align-items: stretch;">
                        <input type="text" id="btcAddress" class="form-control" value="{{ $data->address ?? '' }}"
                               readonly style="flex:1;">
                        <button type="button" class="btn btn-primary copy-btn" onclick="copyAddress()"
                                style="flex:0 0 auto;">Copy
                        </button>
                    </div>
                </div>

                {{-- Countdown Timer / Info --}}
                <div class="alert alert-info p-2 mb-3">
                    <h5 id="total-time-left">Time left: calculating...</h5>
                    <small>If you don't get update after 3 mins, refresh manually.</small>
                </div>


                {{-- Payment Status --}}
                @php
                    $info = '';
                    switch($status){
                        case 0:
                        case 1:
                            $statusText = "<span style='color: orangered' id='status'>PENDING</span>";
                            $info = '<p>Your payment has been received. Invoice will be marked as paid on two blockchain confirmation. Kindly check back in 15mins, you can also confirm your status by clicking the recharge button on your dashboard page.</p>';
                            break;
                        case 2:
                            $statusText = "<span style='color: green; font-weight:bolder; font-size:16px' id='status'>PAID</span>
                             <br><small>You will be redirected to your dashboard in 5 seconds...</small>";
                            break;
                        case -1:
                            $statusText = "<span style='color: red; font-weight:bolder; font-size:16px' id='status'>UNPAID</span>";
                            break;
                        case -2:
                            $statusText = "<span style='color: red; font-weight:bolder; font-size:16px' id='status'>Too little paid, please pay the rest.</span>";
                            break;
                        default:
                            $statusText = "<span style='color: red; font-weight:bolder; font-size:16px' id='status'>Error, expired.</span>";
                    }
                @endphp

                <p>Status: {!! $statusText !!}</p>

                @if($info)
                    <div class="alert alert-light text-left mt-2">
                        {!! $info !!}
                    </div>
                @endif
            </div>
        </div>

        {{-- QR Code Column --}}
        <div class="col-md-6 mb-4">
            <div class="wallet-card text-center">
                <h4>QR Code</h4>
                @php
                    $encodedAddress = urlencode($data->address ?? '');
                    $qrcodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={$encodedAddress}";
                @endphp
                <div class="qr-hold mb-3">
                    <img src="{{ $qrcodeUrl }}" alt="My QR code">
                </div>
            </div>
        </div>

    </div> <!-- .row -->

    <div class="row">
        @include('partials/news')
    </div>

    <div class="row">
        @include('partials/banner')
    </div>

    {{-- Copy Address Script --}}
    <script>
        function copyBTC() {
            const copyText = document.getElementById("btcAmount");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            alert("BTC amount copied: " + copyText.value);
        }

        function copyUSD() {
            const copyText = document.getElementById("usdAmount");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            alert("USD amount copied: " + copyText.value);
        }

        function copyAddress() {
            const copyText = document.getElementById("btcAddress");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            alert("Wallet address copied: " + copyText.value);
        }
    </script>


    {{-- Countdown Timer Script --}}
    <script>
        let count_timer = parseInt(localStorage.getItem("count_timer"));
        if (!count_timer || count_timer < 0 || count_timer > 600) {
            count_timer = 60 * 10; // 10 minutes
            localStorage.setItem("count_timer", count_timer);
        }

        // Countdown function
        function countDownTimer() {
            if (count_timer <= 0) {
                document.getElementById("total-time-left").innerHTML = "Time Left To Pay: -----";
                localStorage.setItem("count_timer", -1);
                return; // stop timer, don't fight with WebSocket reload
            }

            let minutes = Math.floor(count_timer / 60);
            let seconds = count_timer % 60;
            if (seconds < 10) seconds = "0" + seconds;
            if (minutes < 10) minutes = "0" + minutes;

            document.getElementById("total-time-left").innerHTML =
                "Time Left To Pay: " + minutes + " Minutes " + seconds + " Seconds";

            count_timer--;
            localStorage.setItem("count_timer", count_timer);
            setTimeout(countDownTimer, 1000);
        }

        countDownTimer();

        // WebSocket Logic
        let status = parseInt("{{ $statusval }}");

        // Case 1: Already paid
        if (status === 2) {
            document.getElementById("total-time-left").innerHTML = "Payment already confirmed! Redirecting...";
            setTimeout(function () {
                window.location.href = "{{ route('home') }}"; // or dashboard route
            }, 5000);
        }
// Case 2: Not yet paid, listen via WebSocket
        else if (status < 2 && status !== -2 && document.getElementById("btcAddress")) {
            let lastStatus = status;
            let addr = document.getElementById("btcAddress").value;
            let timestamp = Math.floor(Date.now() / 1000) - 5;
            let wsuri = "wss://www.blockonomics.co/payment/" + addr + "?timestamp=" + timestamp;
            let socket = new WebSocket(wsuri);

            socket.onmessage = function (event) {
                let response = JSON.parse(event.data);

                if (response.status > lastStatus) {
                    lastStatus = response.status;

                    // Stop timer
                    localStorage.setItem("count_timer", -1);

                    if (response.status === 2) {
                        document.getElementById("total-time-left").innerHTML = "Payment confirmed! Redirecting to dashboard...";
                        setTimeout(function () {
                            window.location.href = "{{ route('home') }}";
                        }, 5000);
                    } else {
                        window.location.reload();
                    }
                }
            };
        }


    </script>

@endsection
