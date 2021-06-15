@extends('layouts.base')

@section('body')
  <body class="main">
  @yield('content')
{{--  @include('../layout/components/dark-mode-switcher')--}}

  <!-- BEGIN: JS Assets-->
  <script src="{{ asset('icewall/js/app.js') }}"></script>
  <!-- END: JS Assets-->

  @yield('script')
  </body>
@endsection
