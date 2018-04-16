@extends('layouts.app')

@section('scripts')
<script src="{{ asset('/js/plans.js') }}"></script>
@endsection

@section('content')
<h1><span class="mega-octicon octicon-repo"></span>Plans</h1>
<button class="btn btn-primary" id="plan-create"><span class="octicon octicon-plus"></span> Add plan</button>
@if(count($plans))
<nav>
    {{ $plans->links() }}
</nav>
@endif
<div class="row col-sm-12 col-md-6">
    @forelse($plans as $plan)
    <div class="row zebra col-sm-12">
        <div class="col-12 col-sm-6">{{ $plan->name }}</div>
        <div class="col-4 col-sm-2" style="text-align:center;"><button data-toggle="tooltip" title="Edit" class="btn plan-edit" data-id="{{ $plan->id }}" data-name="{{ $plan->name }}"><span class="octicon octicon-pencil"></span></button></div>
        <div class="col-4 col-sm-2" style="text-align:center;"><button data-toggle="tooltip" title="Days" class="btn plan-days" data-id="{{ $plan->id }}""><span class="octicon octicon-calendar"></span></button></div>
        <div class="col-4 col-sm-2" style="text-align:center;"><button data-toggle="tooltip" title="Delete" class="btn plan-delete" data-id="{{ $plan->id }}"><span class="octicon octicon-trashcan"></span></a></div>
    </div>
    @empty
    <h2>No plans found</h2>
    @endforelse
</div>
@if(count($plans))
<nav>
    {{ $plans->links() }}
</nav>
@endif

<!-- Plan modal -->
<div class="modal fade" id="modal-plan" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="modal-plan-title">Create new user</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="modal-plan-form">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Plan name:</label>
                        <input type="text" class="form-control" id="name" />
                    </div>
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

<!-- Days modal -->
<div class="modal fade" id="modal-days" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="modal-days-title">Plan's days</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="modal-days-list">
                </div>
                <form id="modal-days-form">
                    <div class="form-group">
                        <label for="day-name">New day:</label>
                        <input type="text" class="form-control" id="day-name" />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Exercises modal -->
<div class="modal fade" id="modal-exercises" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="modal-days-title">Add exercises</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="modal-exercises-form">
                <!-- Modal body -->
                <div class="modal-body">
                    @foreach($exercises as $exercise)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" name="exercises[]" value="{{ $exercise->id }}" class="form-check-input" /> {{ $exercise->name }}
                        </label>
                    </div>
                    @endforeach
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('modules.loading')
@endsection