<?php

if (Auth::user()->dashboard_style == "light") {
    $bgmenu = "blue";
    $bg = "light";
    $text = "dark";
} else {
    $bgmenu = "dark";
    $bg = "dark";
    $text = "light";
}
?>
@extends('layouts.app')
@section('content')
  @include('user.topmenu')
  @include('user.sidebar')
  <div class="main-panel bg-{{$bg}}">
    <div class="content bg-{{$bg}}">
      <div class="page-inner">
        <div class="row mb-5">
          <div class="col col-6 card p-3 shadow-lg bg-{{$bg}}">
            <div class="mt-2 mb-4">
              <h1 class="title1 text-{{$text}}">Make Your Deposit Here</h1>
            </div>
            <nav>
              <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active pt-3 " id="nav-digest-tab" data-toggle="tab" href="#1" role="tab" aria-controls="nav-digest"
                   aria-selected="true">Digest Chain</a>
                <a class="nav-item nav-link pt-3 " id="nav-btc-tab" data-toggle="tab" href="#2" role="tab" aria-controls="nav-btc"
                   aria-selected="false">BTC Wallet</a>
                <a class="nav-item nav-link pt-3 " id="nav-eth-tab" data-toggle="tab" href="#3" role="tab" aria-controls="nav-eth"
                   aria-selected="false">Ethereum & USDT (ERC20)</a>
              </div>
            </nav>

            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
              <div class="tab-pane fade show active p-3 bg-{{$bg}}" id="1" role="tabpanel"
                   aria-labelledby="nav-digest-tab">
                <div class="card bg-{{$bg}} p-3">
                  <div class="row">
                    <div class="col col-lg-6 col-sm-12">
                      {{ QrCode::size(250)->generate(\App\Models\Settings::first()->btc_address) }}
                    </div>
                    <div class="col col-lg-6 col-sm-12">
                      <h4 class="text-{{$text}}">Make sure to switch your network to Digest Chain!</h4>
                      <h4 class="text-{{$text}}">Please make sure you only send DGC / DCC to this address</h4>
                      <h4 class="text-{{$text}}">Any other Crypto Asset sent here will be lost!</h4>
                      <h4 class="text-{{$text}}">Your deposit will be executed instantly!</h4>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade p-3 bg-{{$bg}}" id="2" role="tabpanel"
                   aria-labelledby="nav-btc-tab">
                <div class="card bg-{{$bg}} p-3">
                  <div class="row">
                    <div class="col col-lg-6 col-sm-12">
                      {{ QrCode::size(250)->generate(\App\Models\Settings::first()->ltc_address) }}
                    </div>
                    <div class="col col-lg-6 col-sm-12">
                      <h4 class="text-{{$text}}">Please make sure you only send BTC to this address</h4>
                      <h4 class="text-{{$text}}">Any other Crypto Asset sent here will be lost!</h4>
                      <h4 class="text-{{$text}}">Your deposit will be executed after 5 confirmations!</h4>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade p-3 bg-{{$bg}}" id="3" role="tabpanel"
                   aria-labelledby="nav-eth-tab">
                <div class="card bg-{{$bg}} p-3">
                  <div class="row">
                    <div class="col col-lg-6 col-sm-12">
                      {{ QrCode::size(250)->generate(\App\Models\Settings::first()->eth_address) }}
                    </div>
                    <div class="col col-lg-6 col-sm-12">
                      <h4 class="text-{{$text}}">Please make sure you only send ETH / USDT (ERC20) to this address</h4>
                      <h4 class="text-{{$text}}">Any other Crypto Asset sent here will be lost!</h4>
                      <h4 class="text-{{$text}}">Your deposit will be executed after 15 confirmations!</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="mb-4">
          <h1 class="title1 text-{{$text}}">Deposits History</h1>
        </div>
        @if(Session::has('message'))
          <div class="row">
            <div class="col-lg-12">
              <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-info-circle"></i> {{ Session::get('message') }}
              </div>
            </div>
          </div>
        @endif

        @if(count($errors) > 0)
          <div class="row">
            <div class="col-lg-12">
              <div class="alert alert-danger alert-dismissable" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                @foreach ($errors->all() as $error)
                  <i class="fa fa-warning"></i> {{ $error }}
                @endforeach
              </div>
            </div>
          </div>
        @endif
        <div class="row mb-5">
          <div class="col text-center card p-4 bg-{{$bg}}">
            <div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table">
              <table class="UserTable table table-hover text-{{$text}}">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Amount</th>
                  <th>Payment mode</th>
                  <th>Status</th>
                  <th>Date created</th>
                </tr>
                </thead>
                <tbody>
                @foreach($deposits as $deposit)
                  <tr>
                    <th scope="row">{{$deposit->id}}</th>
                    <td>{{$settings->currency}}{{$deposit->amount}}</td>
                    <td>{{$deposit->payment_mode}}</td>
                    <td>{{$deposit->status}}</td>
                    <td>{{\Carbon\Carbon::parse($deposit->created_at)->toDayDateTimeString()}}</td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  @include('user.modals')
@endsection
