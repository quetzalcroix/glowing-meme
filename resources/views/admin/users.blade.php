@extends('layouts.side-menu')

@section('subhead')
  <title>Manage Users - Digest TRO</title>
@endsection

@section('subcontent')
  <div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xxl:col-span-9">
      <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 mt-6 -mb-6 intro-y">
          <div class="alert show box bg-theme-26 text-white flex items-center mb-6" role="alert">
            <span>Manage Users</span>
          </div>
        </div>
        <div class="col-span-12 mt-6 -mb-6 intro-y">
          @if($settings->enable_kyc =="yes")
            <a href="{{ url('rangda/v2/dashboard/kyc') }}" class="btn btn-warning w-25 mr-auto">KYC Verification</a>
          @endif
        </div>
        @foreach($users as $user)
          <div class="intro-y col-span-12 md:col-span-6 mt-5">
            <div class="box">
              <div class="flex flex-col lg:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                  <a href="" class="font-medium">{{ $user->name }}</a>
                  <div class="text-gray-600 text-xs mt-0.5">{{ $user->account_verify ?? "Unverified" }}</div>
                  <div class="text-gray-600 text-xs mt-0.5">{{ $user->email}}</div>
                  <div class="text-gray-600 text-xs mt-0.5">{{ Carbon\Carbon::now()->diffForHumans($user->entered_at) }}</div>
                </div>
                <div class="flex -ml-2 lg:ml-0 lg:justify-end mt-3 lg:mt-0">
                  <a href="{{ route('admin.switch-user', ['id' => $user->id]) }}"
                     class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-dark-5 ml-2 text-gray-500 zoom-in tooltip"
                     title="Get Access to User Dashboard"
                  >
                    <i class="w-3 h-3 fill-current" data-feather="key"></i>
                  </a>
                </div>
              </div>
              <div class="flex flex-wrap lg:flex-nowrap items-center justify-center p-5">
                <div class="w-full mb-4 lg:mb-0 mr-auto">
                  <div class="flex text-gray-600 text-xs">
                    <a class="btn btn-primary-soft py-1 px-2 mr-2" href="{{ url('rangda/v2/dashboard/user-plans') }}/{{$user->id}}">Packages</a>
                    <a class="btn btn-secondary py-1 px-2 mr-2" href="{{ url('rangda/v2/dashboard/user-wallet') }}/{{$user->id}}">See Wallet</a>
                    @if($user->status==null || $user->status=='blocked')
                      <a class="btn btn-success-soft py-1 px-2 mr-2" href="{{ url('rangda/v2/dashboard/uunblock') }}/{{$user->id}}">Unblock</a>
                    @else
                      <a class="btn btn-danger-soft py-1 px-2 mr-2" href="{{ url('rangda/v2/dashboard/uublock') }}/{{$user->id}}">Block</a>
                    @endif
                    @if($user->trade_mode=='on')
                      <a class="btn btn-danger-soft py-1 px-2 mr-2" href="{{ url('rangda/v2/dashboard/usertrademode')
                      }}/{{$user->id}}/off">Disable Trade</a>
                    @else
                      <a class="btn btn-success py-1 px-2 mr-2" href="{{ url('rangda/v2/dashboard/usertrademode') }}/{{$user->id}}/on">Enable
                        Trade</a>
                    @endif
                    {{--                    <a href="#" data-toggle="modal" data-target="#topupModal{{$list->id}}" class="m-1 btn btn-dark btn-sm">Credit/Debit</a>--}}
                    {{--                    <a href="#" data-toggle="modal" data-target="#resetpswdModal{{$list->id}}" class="m-1 btn btn-warning btn-sm">Reset--}}
                    {{--                      Password</a>--}}
                    {{--                    <a href="#" data-toggle="modal" data-target="#clearacctModal{{$list->id}}" class="m-1 btn btn-warning btn-sm">Clear--}}
                    {{--                      Account</a>--}}
                    {{--                    <a href="#" data-toggle="modal" data-target="#TradingModal{{$list->id}}" class="m-1 btn btn-secondary btn-sm">Add Trading--}}
                    {{--                      History</a>--}}
                    {{--                    <a href="#" data-toggle="modal" data-target="#deleteModal{{$list->id}}" class="m-1 btn btn-danger btn-sm">Delete</a>--}}
                    {{--                    <a href="#" data-toggle="modal" data-target="#edituser{{$list->id}}" class="m-1 btn btn-secondary btn-sm">Edit</a>--}}
                    {{--                    <a href="#" data-toggle="modal" data-target="#sendmailtooneuserModal{{$list->id}}" class="m-1 btn btn-info btn-sm">Send--}}
                    {{--                      Message</a>--}}
                  </div>
                  <div class="progress h-1 mt-2">
                    <div class="progress-bar w-1/4 bg-theme-17" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection
