<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="{{ $dark_mode ? 'dark' : '' }}">
<head>
  <meta charset="utf-8">
  <link href="{{ asset('images/logo_tro.png') }}" rel="shortcut icon">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Profitable Cryptoasset Trading Operation for everyone">
  <meta name="keywords" content="crypto, trading, robot, crypto trading, crypto trading robot">
  <meta name="author" content="{{ config('app.author', 'PT. Digital Aset Group') }}">

@yield('head')

<!-- BEGIN: CSS Assets-->
  <link rel="stylesheet" href="{{ asset('icewall/css/app.css') }}" />
  <!-- END: CSS Assets-->
</head>
<!-- END: Head -->

@yield('body')

</html>
