<aside id="menubar" class="menubar light">
  <div class="app-user">
    <div class="media">
      <div class="media-left">
      </div>
      <div class="media-body">
        <div class="foldable">
          <h5><a href="javascript:void(0)" class="username">Welcome {{ auth()->user()->username}}</a></h5>
        </div>
      </div><!-- .media-body -->
    </div><!-- .media -->
  </div><!-- .app-user -->
  <div class="menubar-scroll">
    <div class="menubar-scroll-inner">
      <ul class="app-menu">
        <li >
          <a href="{{ route('home')}}" >
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">Dashboard</span>
          </a>
        </li>


        @if(auth()->user()->role == "admin")
{{--        <li>--}}
{{--          <a href="{{ asset('admin/announcement/1')}}" >--}}
{{--            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>--}}
{{--            <span class="menu-text">News</span>--}}
{{--          </a>--}}
{{--        </li>--}}
{{--        <li>--}}
        <a href="{{ route('admin.users')}}" >
          <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
          <span class="menu-text">Users</span>
        </a>
      </li>
        <li>
          <a href="{{ route('admin.history')}}" >
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">History</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.invoice')}}" >
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">Invoices</span>
          </a>
        </li>
        <li>
        <a href="{{ asset('admin/redemption')}}" >
          <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
          <span class="menu-text">Orders</span>
        </a>
      </li>
{{--      <li>--}}
{{--        <a href="{{ route('admin.credit.user.form')}}" >--}}
{{--          <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>--}}
{{--          <span class="menu-text">Credit User</span>--}}
{{--        </a>--}}
{{--      </li>--}}
{{--      <li>--}}
{{--        <a href="{{ route('admin.edited.picture')}}" >--}}
{{--          <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>--}}
{{--          <span class="menu-text">Upload Edited image</span>--}}
{{--        </a>--}}
{{--      </li>--}}
        @else

              <li>
                  <a href="{{ route('home.packages')}}" >
                      <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                      <span class="menu-text">Packages</span>
                  </a>
              </li>
              <li>
                  <a href="{{ route('home.history')}}" >
                      <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                      <span class="menu-text">History</span>
                  </a>
              </li>
              <li>
                  <a href="{{ route('payment.withdraw')}}" >
                      <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                      <span class="menu-text">Withdraw</span>
                  </a>
              </li>
              <li>
                  <a href="{{ route('home.support')}}" >
                      <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                      <span class="menu-text">Faq & Support</span>
                  </a>
              </li>
{{--              <li>--}}
{{--                  <a href="{{ route('home.packages')}}" >--}}
{{--                      <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>--}}
{{--                      <span class="menu-text">Withdrawal</span>--}}
{{--                  </a>--}}
{{--              </li>--}}
{{--        <li class="has-submenu">--}}
{{--          <a href="javascript:void(0)" class="submenu-toggle">--}}
{{--            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>--}}
{{--            <span class="menu-text">Bank Statements</span>--}}
{{--            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>--}}
{{--          </a>--}}
{{--          <ul class="submenu">--}}
{{--            <li><a href="{{asset('statements')}}"><span class="menu-text">Banks</span></a></li>--}}
{{--            <li><a href="{{asset('custom-statements')}}"><span class="menu-text">Customize Bank</span></a></li>--}}

{{--          </ul>--}}
{{--        </li>--}}

{{--       <li class="has-submenu">--}}
{{--          <a href="javascript:void(0)" class="submenu-toggle">--}}
{{--            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>--}}
{{--            <span class="menu-text">Business License</span>--}}
{{--            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>--}}
{{--          </a>--}}
{{--          <ul class="submenu">--}}
{{--          <li><a href="{{asset('einletter')}}"><span class="menu-text">EIN Letter</span></a></li>--}}
{{--          </ul>--}}
{{--        </li>--}}


{{--        <li>--}}
{{--          <a href="{{ asset('divorce-certificate')}}" >--}}
{{--            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>--}}
{{--            <span class="menu-text">Divorce Certificate </span>--}}
{{--          </a>--}}
{{--        </li>--}}

{{--      <li>--}}
{{--        <a href="{{ asset('payment/customize/edit-picture')}}" >--}}
{{--          <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>--}}
{{--          <span class="menu-text">Image Edit Request</span>--}}
{{--        </a>--}}
{{--      </li>--}}

{{--      <li>--}}
{{--        <a href="{{ asset('lawyers-license')}}" >--}}
{{--          <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>--}}
{{--          <span class="menu-text">Lawyers License</span>--}}
{{--        </a>--}}
{{--      </li>--}}

{{--        <li>--}}
{{--          <a href="{{ asset('passports')}}" >--}}
{{--            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>--}}
{{--            <span class="menu-text">Passport </span>--}}
{{--          </a>--}}
{{--        </li>--}}

{{--        <li>--}}
{{--          <a href="{{route('paystubs.index')}}" >--}}
{{--            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>--}}
{{--            <span class="menu-text">PayStubs</span>--}}
{{--          </a>--}}
{{--        </li>--}}


{{--        <li class="has-submenu">--}}
{{--          <a href="javascript:void(0)" class="submenu-toggle">--}}
{{--            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>--}}
{{--            <span class="menu-text">Rental Docs</span>--}}
{{--            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>--}}
{{--          </a>--}}
{{--          <ul class="submenu">--}}
{{--            <li><a href="{{asset('rental/notice-to-vacate')}}"><span class="menu-text"> Notice To Vacate</span></a></li>--}}
{{--            <li><a href="{{asset('rental/late-rent')}}"><span class="menu-text">Late Rent</span></a></li>--}}
{{--            <li><a href="{{asset('rental/lease-agreement')}}"><span class="menu-text">Lease Agreement</span></a></li>--}}
{{--          </ul>--}}
{{--        </li>--}}




{{--        <li>--}}
{{--          <a href="{{ asset('license/index')}}" >--}}
{{--            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>--}}
{{--            <span class="menu-text">Scannable DL</span>--}}
{{--          </a>--}}
{{--        </li>--}}

{{--        <li>--}}
{{--          <a href="{{asset('socials')}}" >--}}
{{--            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>--}}
{{--            <span class="menu-text">SSN </span>--}}
{{--          </a>--}}
{{--        </li>--}}



{{--        <li>--}}
{{--          <a href="{{ asset('sms')}}" >--}}
{{--            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>--}}
{{--            <span class="menu-text">SMS Verification </span>--}}
{{--          </a>--}}
{{--        </li>--}}


{{--        <li class="has-submenu">--}}
{{--          <a href="javascript:void(0)" class="submenu-toggle">--}}
{{--            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>--}}
{{--            <span class="menu-text">Tax Docs</span>--}}
{{--            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>--}}
{{--          </a>--}}
{{--          <ul class="submenu">--}}
{{--            <li><a href="{{asset('tax-documents')}}"><span class="menu-text">1040 Schedule C</span></a></li>--}}
{{--            <li><a href="{{asset('1099/contractor')}}"><span class="menu-text">1099</span></a></li>--}}
{{--            <li><a href="{{asset('w2/employee')}}"><span class="menu-text">W-2</span></a></li>--}}
{{--            <li><a href="{{asset('einletter')}}"><span class="menu-text">EIN Letter</span></a></li>--}}
{{--          </ul>--}}
{{--        </li>--}}




{{--        <li class="has-submenu">--}}
{{--          <a href="javascript:void(0)" class="submenu-toggle">--}}
{{--            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>--}}
{{--            <span class="menu-text">Utility Bill</span>--}}
{{--            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>--}}
{{--          </a>--}}
{{--          <ul class="submenu">--}}
{{--            <li><a href="{{asset('utility/energy')}}"><span class="menu-text">Energy</span></a></li>--}}
{{--            <li> <a href="{{asset('utility')}}" ><span class="menu-text">Internet</span></a></li>--}}
{{--          </ul>--}}
{{--        </li>--}}





{{--        <li>--}}
{{--          <a href="{{route('voidcheck.index')}}" >--}}
{{--            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>--}}
{{--            <span class="menu-text">Void Checks</span>--}}
{{--          </a>--}}
{{--        </li>--}}

{{--          <li>--}}
{{--          <a href="{{route('wills.index')}}" >--}}
{{--            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>--}}
{{--            <span class="menu-text">Will</span>--}}
{{--          </a>--}}
{{--        </li>--}}
{{--
<hr>
<h5><a href="javascript:void(0)" class="username">Coming soon <br> (October 2021)</a></h5>










        <li>
          <a href="{{route('home')}}" >
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">Proof of Employment</span>
          </a>
        </li>

        <li>
          <a href="{{route('home')}}" >
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">Bank Checks</span>
          </a>
        </li>
        <li>
          <a href="{{route('home')}}" >
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">ID Card Services </span>
          </a>
        </li>
        <li>
          <a href="{{route('home')}}" >
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">Next of Kin Docs </span>
          </a>
        </li>
        <li>
          <a href="{{route('home')}}" >
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">Client Billing Docs </span>
          </a>
        </li>
        <li>
          <a href="{{route('home')}}" >
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">Contract Docs</span>
          </a>
        </li>
        <li>
          <a href="{{route('home')}}" >
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">Airline Ticket</span>
          </a>
        </li>
        <li>
          <a href="{{route('home')}}" >
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">Special Request (24hrs)</span>
          </a>
        </li> --}}



        <li>
          @endif
        <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="menu-icon fa fa-power-off"></i>  <span class="menu-text"> {{ __('Logout') }}</span>
        </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
      </ul><!-- .app-menu -->
    </div><!-- .menubar-scroll-inner -->
  </div><!-- .menubar-scroll -->
</aside>


