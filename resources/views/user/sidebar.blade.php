<div class="sidebar sidebar-style-2" data-background-color="{{$bg}}">
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-primary">
        <li class="nav-item">
          <a data-toggle="collapse" href="#bases">
            <i class="fas fa-user"></i>
            <p>{{ Auth::user()->name }}</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="bases">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ url('dashboard/profile') }}">
                  <i class="fa fa-user-edit"></i>
                  <p>Account Settings</p>
                </a>
              </li>
              <li>
                <a href="{{ url('dashboard/tradinghistory') }}">
                  <i class="fa fa-chart-area" aria-hidden="true"></i>
                  <p>PnL Records</p>
                </a>
              </li>
{{--              <li>--}}
{{--                <a href="{{ url('dashboard/notification') }}">--}}
{{--                  <span class="sub-item">Notifications</span>--}}
{{--                </a>--}}
{{--              </li>--}}
            </ul>
          </div>
        </li>
        <li class="nav-item mt-4 {{ Request::url() == route('dashboard') ? 'active' : '' }}">
          <a href="{{ url('/dashboard') }}">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item {{ Request::url() == route('deposits') ? 'active' : '' }}">
          <a href="{{ url('dashboard/deposits') }}">
            <i class="fas fa-credit-card"></i>
            <p>Deposits</p>
          </a>
        </li>
        <li class="nav-item">
          <a data-toggle="collapse" href="#mpack">
            <i class="fas fa-cubes"></i>
            <p>Partnership</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="mpack">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ url('dashboard/mplans') }}">
                  <p>Trading Contract</p>
                </a>
              </li>
              <li>
                <a href="{{ url('dashboard/myplans') }}">
                  <p>Active Contract</p>
                </a>
              </li>
              <li>
                <a href="{{ url('dashboard/subtrade') }}">
                  <p>TRO Autotrade</p>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item {{ Request::url() == route('referuser') ? 'active' : '' }}">
          <a href="{{ url('dashboard/referuser') }}">
            <i class="flaticon-network " aria-hidden="true"></i>
            <p>Referrals</p>
          </a>
        </li>
        <li class="nav-item {{ Request::url() == route('accounthistory') ? 'active' : '' }}">
          <a href="{{ url('dashboard/accounthistory') }}">
            <i class="fa fa-briefcase " aria-hidden="true"></i>
            <p>Transactions History</p>
          </a>
        </li>
        <li class="nav-item {{ Request::url() == route('user.withdrawal') || Request::url() == route('user.withdrawal-info')  ? 'active' : '' }}">
          <a data-toggle="collapse" href="#dept">
            <i class="fas fa-credit-card"></i>
            <p>Withdrawal</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="dept">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ url('dashboard/withdrawals') }}">
                  <span class="sub-item">Withdrawal</span>
                </a>
              </li>
              <li>
                <a href="{{ url('dashboard/accountdetails') }}">
                  <span class="sub-item">My Payment Info</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a href="{{ url('dashboard/support') }}">
            <i class="fa fa-life-ring" aria-hidden="true"></i>
            <p>Support</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
