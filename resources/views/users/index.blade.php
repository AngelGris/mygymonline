@extends('layouts.app')

@section('styles')
<link href="{{ asset('/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endsection

@section('scripts')
<script src="{{ asset('/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('/js/users.js') }}"></script>
@endsection

@section('content')
<h1><span class="mega-octicon octicon-organization"></span>Users</h1>
<button class="btn btn-primary" id="user-create"><span class="octicon octicon-plus"></span> Add user</button>
@if(count($users))
<nav>
    {{ $users->links() }}
</nav>
@endif
<div class="row col-sm-12 col-md-6">
    @forelse($users as $user)
    <div class="row zebra col-sm-12">
        <div class="col-12 col-sm-6">{{ $user->full_name }}</div>
        <div class="col-4 col-sm-2" style="text-align:center;"><button data-toggle="tooltip" title="Edit" class="btn user-edit" data-id="{{ $user->id }}" data-first-name="{{ $user->first_name }}" data-last-name="{{ $user->last_name }}" data-email="{{ $user->email }}" data-birthdate="{{ $user->birthdate->format('d/m/Y') }}" data-height="{{ $user->height }}" data-weigth="{{ $user->weigth }}"><span class="octicon octicon-pencil"></span></button></div>
        <div class="col-4 col-sm-2" style="text-align:center;"><button data-toggle="tooltip" title="Plans" class="btn user-plans" data-id="{{ $user->id }}"><span class="octicon octicon-repo"></span></button></div>
        <div class="col-4 col-sm-2" style="text-align:center;"><button data-toggle="tooltip" title="Delete" class="btn user-delete" data-id="{{ $user->id }}"><span class="octicon octicon-trashcan"></span></a></div>
    </div>
    @empty
    <h2>No users found</h2>
    @endforelse
</div>
@if(count($users))
<nav>
    {{ $users->links() }}
</nav>
@endif

<!-- User modal -->
<div class="modal fade" id="modal-user" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="modal-user-title">Create new user</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="modal-user-form">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="first-name">First name:</label>
                        <input type="text" class="form-control" id="first-name" />
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last name:</label>
                        <input type="text" class="form-control" id="last-name" />
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" class="form-control" id="email" />
                    </div>
                    <div class="form-group">
                        <label for="birthdate">Birthdate:</label>
                        <input type="text" class="form-control" id="birthdate" />
                    </div>
                    <div class="form-group">
                        <label for="height">Height (cm):</label>
                        <input type="text" class="form-control" id="height" />
                    </div>
                    <div class="form-group">
                        <label for="weight">Weigth (kg):</label>
                        <input type="text" class="form-control" id="weigth" />
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="modal-user-save">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Plans modal -->
<div class="modal fade" id="modal-plans" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">User's plans</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="modal-plans-form">
                <!-- Modal body -->
                <div class="modal-body">
                    @foreach ($plans as $plan)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" name="plans[]" id="plan-{{ $plan->id }}" value="{{ $plan->id }}" class="form-check-input" /> {{ $plan->name }}
                        </label>
                    </div>
                    @endforeach
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('modules.loading')
@endsection