@extends('layouts.side-menu')

@section('subhead')
  <title>Update Profile - Digest TRO</title>
@endsection

@section('subcontent')
  <div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Change Password</h2>
  </div>
  <div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
      <form class="intro-y box lg:mt-5" method="post" action="{{route('admin.update-pass')}}">
        @csrf
        <div class="p-5">
          <div>
            <label class="form-label">Current Password</label>
            <input name="old_password" type="password" class="form-control" placeholder="Current Password">
          </div>
          <div class="mt-3">
            <label class="form-label">New Password</label>
            <input name="password" type="password" class="form-control" placeholder="New Password">
          </div>
          <div class="mt-3">
            <label class="form-label">Confirm New Password</label>
            <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm New Password">
          </div>
          <div class="mt-3">
            <input type="submit" class="btn btn-primary" value="Change Password">
          </div>
          <input type="hidden" name="id" value="{{auth('admin')->user()->id}}">
          <input type="hidden" name="current_password" value="{{auth('admin')->user()->password}}">
        </div>
      </form>
    </div>
  </div>
@endsection
