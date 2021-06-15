@extends('layouts.main')

@section('head')
  @yield('subhead')
@endsection

@section('content')
  {{--    @include('../layout/components/mobile-menu')--}}
  @include('layouts.components.top-bar')
  <div class="wrapper">
    <div class="wrapper-box">
      <nav class="side-nav">
        <ul>
          <li>
            <a href="{{ route('admin.dashboard') }}"
               class="{{ Request::url() == route('admin.dashboard') ? 'side-menu side-menu--active' : 'side-menu' }}">
              <div class="side-menu__icon">
                <i data-feather="home"></i>
              </div>
              <div class="side-menu__title">
                Dashboard
              </div>
            </a>
          </li>
          @auth('admin')
            <li>
              <a href="{{ route('admin.manage-users') }}"
                 class="{{ Request::url() == route('admin.manage-users') ? 'side-menu side-menu--active' : 'side-menu' }}">
                <div class="side-menu__icon">
                  <i data-feather="users"></i>
                </div>
                <div class="side-menu__title">
                  User Management
                </div>
              </a>
            </li>
            <li>
              <a href="{{ route('admin.manage-membership') }}"
                 class="{{ Request::url() == route('admin.manage-membership') ? 'side-menu side-menu--active' : 'side-menu' }}">
                <div class="side-menu__icon">
                  <i data-feather="award"></i>
                </div>
                <div class="side-menu__title">
                  TRO Packages
                </div>
              </a>
            </li>
            <li>
              <a href="{{ route('admin.manage-membership') }}"
                 class="{{ Request::url() == route('admin.manage-membership') ? 'side-menu side-menu--active' : 'side-menu' }}">
                <div class="side-menu__icon">
                  <i data-feather="award"></i>
                </div>
                <div class="side-menu__title">
                  TRO Bot Subscriptions
                </div>
              </a>
            </li>
            <li class="side-nav__devider my-6"></li>
            <li>
              <a href="{{ route('admin.manage-deposits') }}"
                 class="{{ Request::url() == route('admin.manage-deposits') ? 'side-menu side-menu--active' : 'side-menu' }}">
                <div class="side-menu__icon">
                  <i data-feather="database"></i>
                </div>
                <div class="side-menu__title">
                  User Deposits
                </div>
              </a>
            </li>
            <li>
              <a href="{{ route('admin.manage-withdrawals') }}"
                 class="{{ Request::url() == route('admin.manage-withdrawals') ? 'side-menu side-menu--active' : 'side-menu' }}">
                <div class="side-menu__icon">
                  <i data-feather="database"></i>
                </div>
                <div class="side-menu__title">
                  User Withdrawals
                </div>
              </a>
            </li>
            <li class="side-nav__devider my-6"></li>
          @endauth
          @if(auth('admin')->user()->type == "Super Admin")
            <li>
              <a href="{{ route('admin.manage-admins') }}"
                 class="{{ Request::url() == route('admin.manage-admins') ? 'side-menu side-menu--active' : 'side-menu' }}">
                <div class="side-menu__icon">
                  <i data-feather="database"></i>
                </div>
                <div class="side-menu__title">
                  Manage Admins
                </div>
              </a>
            </li>
            <li>
              <a href="{{ route('admin.settings') }}"
                 class="{{ Request::url() == route('admin.settings') ? 'side-menu side-menu--active' : 'side-menu' }}">
                <div class="side-menu__icon">
                  <i data-feather="database"></i>
                </div>
                <div class="side-menu__title">
                  Settings
                </div>
              </a>
            </li>
          @endif
        </ul>
      </nav>
      <div class="content">
        @yield('subcontent')
      </div>
    </div>
  </div>
@endsection
