@extends('layouts.base')

@section('body')
  <body class="login">
  @yield('content')

  <script src="{{ asset('icewall/js/app.js') }}"></script>

  @yield('script')
  </body>
@endsection
