@extends('layouts.app')

@section('navbar')
    @include('partials.navLoggedIn')
@endsection

@include('partials.addFriend');
@include('partials.joinEvent');
@include('partials.addEvent');

@section('content')
  @if(Auth::user()->is_admin)
    @include('partials.admin')
  @else
    @include('partials.homepage')
  @endif
@endsection
