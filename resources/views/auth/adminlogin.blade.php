@extends('layouts.login')

@section('head')
  <title>Login - Digest TRO</title>
@endsection

@section('content')
  <div class="container sm:px-10">
    <div class="block xl:grid grid-cols-2 gap-4">
      <div class="hidden xl:flex flex-col min-h-screen">
        <div class="my-auto">
          <img alt="Digest TRO" class="-intro-x w-1/2 -mt-16" src="{{ asset('images/tro_logo_metal.png') }}">
          <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">Wide Range of Autotrade Systems</div>
          <div class="-intro-x text-white font-medium text-2xl leading-tight ">Everyone Can Start Trading</div>
        </div>
      </div>
      <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
        <div
          class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
          <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Administrator Login</h2>
          <form method="POST" action="{{ route('adminLogin') }}" class="mt-5 card__form">
            @csrf
            <div class="intro-x mt-8">
              <input type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block"
                     name="email" value="{{ old('email') }}" id="email" placeholder="name@example.com" required>
              <input type="password" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4"
                     name="password" id="password" placeholder="Enter Password" required>
            </div>
            <div class="intro-x flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm mt-4">
              <a href="{{ route('password.request') }}">Forgot Password?</a>
            </div>
            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
              <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Login</button>
            </div>
            <div class="intro-x mt-10 xl:mt-24 text-gray-700 dark:text-gray-600 text-center xl:text-left">
              <small class="text-center ">&copy; Copyright {{date('Y')}} &nbsp; {{$settings->site_name}} &nbsp; All Rights Reserved.</small>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
