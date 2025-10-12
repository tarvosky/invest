<?php

$user = auth()->user();

?>

<!-- APP NAVBAR ==========-->
<nav id="app-navbar" class="navbar navbar-inverse navbar-fixed-top primary">

  <div class="navbar-header">
    <button type="button" id="menubar-toggle-btn" class="navbar-toggle visible-xs-inline-block navbar-toggle-left hamburger hamburger--collapse js-hamburger">
      <span class="sr-only">Toggle navigation</span>
      <span class="hamburger-box"><span class="hamburger-inner"></span></span>
    </button>

    <button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
      <span class="sr-only">Toggle navigation</span>
      <span class="zmdi zmdi-hc-lg zmdi-more"></span>
    </button>


    <a href="{{ route('home')}}" class="navbar-brand">
      @include('partials/logo')
      <span class="brand-name">{{ env('APP_NAME') }}</span>
    </a>
  </div>




  <!-- navbar header -->
 <!-- .navbar-header -->
  <div class="navbar-container container-fluid">
    <div class="collapse navbar-collapse" id="app-navbar-collapse">
      <ul class="nav navbar-toolbar navbar-toolbar-left navbar-left">
        {{-- <li class="hidden-float hidden-menubar-top">
          <a href="javascript:void(0)" role="button" id="menubar-fold-btn" class="hamburger hamburger--arrowalt is-active js-hamburger">
            <span class="hamburger-box"><span class="hamburger-inner"></span></span>
          </a>
        </li> --}}
        <li>
          {{-- <h5 class="page-title hidden-menubar-top hidden-float">Dashboard</h5> --}}
        </li>
      </ul>

      <ul class="nav navbar-toolbar navbar-toolbar-right navbar-right">

        <div class="app-user">
          <div class="media">
            <div class="media-left">
              <div class="avatar avatar-md avatar-circle dropdown open">
                <a href="javascript:void(0)" data-toggle="dropdown" aria-expanded="true"><img class="img-responsive" src="{{ 'license/photo/sample.jpg'}}" alt="avatar"></a>
              <ul class="dropdown-menu animated flipInY">
                      {{-- <li>
                        <a class="text-color" href="/index.html">
                          <span class="m-r-xs"><i class="fa fa-home"></i></span>
                          <span>Home</span>
                        </a>
                      </li>
                      <li>
                        <a class="text-color" href="profile.html">
                          <span class="m-r-xs"><i class="fa fa-user"></i></span>
                          <span>Profile</span>
                        </a>
                      </li> --}}
                      {{-- <li>
                        <a class="text-color" href="settings.html">
                          <span class="m-r-xs"><i class="fa fa-gear"></i></span>
                          <span>Settings</span>
                        </a>
                      </li> --}}
                      <li role="separator" class="divider"></li>
                      <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          <i class="menu-icon fa fa-power-off"></i>  <span class="menu-text"> {{ __('Logout') }}</span>
                       </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                      </li>
                    </ul></div><!-- .avatar -->
            </div>

          </div><!-- .media -->
        </div>


{{--        <li>--}}
{{--          <a href="{{ asset('sms')}}" >SMS Verification</a>--}}
{{--        </li>--}}

{{--        <li class="dropdown">--}}
{{--          <a href="{{ route('home.history')}}" >History</a>--}}
{{--        </li>--}}



          <li >
              <a href="{{ route('about')}}" >About Us</a>
          </li>
          <li >
              <a href="{{ route('testimony')}}" >Testimonies</a>
          </li>
        <li >
          <a href="{{ route('home.support')}}" >Contact Us</a>
        </li>
        <li >
          <a href="{{ route('home.support')}}" >White Paper</a>
        </li>
{{--        <li >--}}
{{--          <a>Wallet  <span id="wallet"></span>  <i onClick='clickWallet()' class="fas fa-refresh text-white"></i></a>--}}

{{--        </li>--}}
      </ul>
    </div>
  </div><!-- navbar-container -->
</nav>
<!--========== END app navbar -->


@push('scripts')

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>

<script type="text/javascript">
function JSFunction() {
    alert('In test Function');   // This demonstrates that the function was called
}
</script>

<script type="text/javascript">


  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(document).ready(function() {
         $.ajax({  //create an ajax request to display.php
          type: "GET",
          url: "{{ asset('ajax/get-balance/'. $user->id )}}",
          success: function (data) {
           // var theUrl = "{{ asset('license/photo') }}";
            $("#wallet").html( "( $"+ data.success + " )");
            console.log(data.success);
          //  document.getElementById("wallet").src = theUrl+"/"+data.success;
           //$('#wallet').append(data.successresponse);
          },
            error: function (data) {
            var errors = $.parseJSON(data.responseText);
            console.log(errors);
            }
        });
      });







  function clickWallet()
  {

         $.ajax({  //create an ajax request to display.php
          type: "GET",
          url: "{{ asset('ajax/get-balance/'. $user->id )}}",
          success: function (data) {
           // var theUrl = "{{ asset('license/photo') }}";
            $("#wallet").html( "( $"+ data.success + " )");
            console.log(data.success);
          //  document.getElementById("wallet").src = theUrl+"/"+data.success;
           //$('#wallet').append(data.successresponse);
          },
            error: function (data) {
            var errors = $.parseJSON(data.responseText);
            console.log(errors);
            }
        });


  }
</script>




@endpush
