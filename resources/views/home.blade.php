@extends('layouts.app')

@section('content')
<h1><span class="mega-octicon octicon-settings"></span>Dashboard</h1>
<div class="row" style="text-align:center">
    <div class="col-sm-6">
        <a href="{{ route('users') }}">
            <span class="mega-octicon octicon-organization"></span>
            <h3>Users</h3>
            <h4>{{ $users }}</h4>
        </a>
    </div>
    <div class="col-sm-6">
        <a href="{{ route('plans') }}">
            <span class="mega-octicon octicon-repo"></span>
            <h3>Plans</h3>
            <h4>{{ $plans }}</h4>
        </a>
    </div>
</div>
@endsection