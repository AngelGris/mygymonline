@extends('layouts.app')

@section('content')
<h1><span class="mega-octicon octicon-settings"></span>Dashboard</h1>
<div class="row" style="text-align:center">
    <div class="col-sm-6">
        <span class="mega-octicon octicon-organization"></span>
        <h3>Users</h3>
        <h4>{{ $users }}</h4>
    </div>
    <div class="col-sm-6">
        <span class="mega-octicon octicon-repo"></span>
        <h3>Plans</h3>
        <h4>{{ $plans }}</h4>
    </div>
</div>
@endsection