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
        <div class="mt-2 mb-4">
          <h1 class="text-{{$text}}">My Payment Information</h1>
        </div>
        @if(session()->has('message'))
          <script>
              const msg = '{{Session::get('message')}}';
              swal({
                  title: "Message",
                  text: msg,
                  icon: "info",
                  buttons: {
                      confirm: {
                          text: "Okay",
                          value: true,
                          visible: true,
                          className: "btn btn-info",
                          closeModal: true
                      }
                  }
              });
          </script>
        @endif
        @if($errors->any())
          <script>
              const msg = '{{ $errors->first() }}';
              swal({
                  title: "Message",
                  text: msg,
                  icon: "danger",
                  buttons: {
                      confirm: {
                          text: "Okay",
                          value: true,
                          visible: true,
                          className: "btn btn-info",
                          closeModal: true
                      }
                  }
              });
          </script>
        @endif

        <div class="mb-4 row">
          <div class="col col-6 card p-3 shadow-lg bg-{{$bg}}">
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
                @if(auth()->user()->btc_address)
                  <div class="card bg-{{$bg}} p-3">
                    <div class="row">
                      <div class="col col-lg-6 col-sm-12">
                        {!! QrCode::size(250)->generate(auth()->user()->btc_address); !!}
                      </div>
                      <div class="col col-lg-6 col-sm-12">
                        <h4 class="text-{{$text}}">This is your DGC & DCC Coin Wallet Address</h4>
                        <h5 class="text-{{$text}}">Please make sure that the address is correct</h5>
                      </div>
                    </div>
                  </div>
                @endif
                <form method="post" action="{{route('updateacount')}}">
                  <div class="form-group">
                    <h5 class="text-{{$text}}">DGC Wallet Address</h5>
                    <input type="text" name="btc_address" value="{{auth()->user()->btc_address}}" class="form-control text-{{$text}} bg-{{$bg}}"
                           placeholder="Your DGC Address">
                  </div>
                  <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{auth()->user()->id}}">
                  </div>
                </form>
              </div>
              <div class="tab-pane fade p-3 bg-{{$bg}}" id="2" role="tabpanel"
                   aria-labelledby="nav-btc-tab">
                @if(auth()->user()->ltc_address)
                  <div class="card bg-{{$bg}} p-3">
                    <div class="row">
                      <div class="col col-lg-6 col-sm-12">
                        {!! QrCode::size(250)->generate(auth()->user()->ltc_address); !!}
                      </div>
                      <div class="col col-lg-6 col-sm-12">
                        <h4 class="text-{{$text}}">This is your BTC Wallet Address</h4>
                        <h5 class="text-{{$text}}">Please make sure that the address is correct</h5>
                      </div>
                    </div>
                  </div>
                @endif
                <form method="post" action="{{route('updateacount')}}">
                  @csrf
                  <div class="form-group">
                    <h5 class="text-{{$text}}">BTC Wallet Address</h5>
                    <input type="text" name="ltc_address" value="{{auth()->user()->ltc_address}}" class="form-control text-{{$text}} bg-{{$bg}}"
                           placeholder="Your Bitcoin Address">
                  </div>
                  <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{auth()->user()->id}}">
                  </div>
                </form>
              </div>
              <div class="tab-pane fade p-3 bg-{{$bg}}" id="3" role="tabpanel"
                   aria-labelledby="nav-eth-tab">
                @if(auth()->user()->eth_address)
                  <div class="card bg-{{$bg}} p-3">
                    <div class="row">
                      <div class="col col-lg-6 col-sm-12">
                        {!! QrCode::size(250)->generate(auth()->user()->eth_address); !!}
                      </div>
                      <div class="col col-lg-6 col-sm-12">
                        <h4 class="text-{{$text}}">This is your ETH & USDT (ERC20) Wallet Address</h4>
                        <h5 class="text-{{$text}}">Please make sure that the address is correct</h5>
                      </div>
                    </div>
                  </div>
                @endif
                <form method="post" action="{{route('updateacount')}}">
                  @csrf
                  <div class="form-group">
                    <h5 class="text-{{$text}}">Ethereum Wallet Address</h5>
                    <input type="text" name="eth_address" value="{{auth()->user()->eth_address}}" class="form-control text-{{$text}} bg-{{$bg}}"
                           placeholder="Your Ethereum Address">
                  </div>
                  <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{auth()->user()->id}}">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
