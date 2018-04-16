var plan_id = 0; // 0 to create new plan, other value to edit
var day_id = 0; // 0 to create new plan, other value to edit

$(function() {
    // Show modal to create new plan
    $('#plan-create').click(function() {
        // Clear plan_id
        plan_id = 0;

        clearFormValues();
        $('#modal-plan-title').text('Create New Plan');
        $('#modal-plan').modal('show');
    });

    // Show modal to edit a plan
    $('.plan-edit').click(function() {
        // Put plan data in modal
        plan_id = $(this).data('id');
        $('#name').val($(this).data('name'));

        // Show modal
        $('#modal-plan-title').text('Edit Plan');
        $('#modal-plan').modal('show');
    });

    // Show modal to edit days
    $('.plan-days').click(function() {
        // Save plan ID and load days
        plan_id = $(this).data('id');
        loadPlanDays();

        $('#modal-days').modal('show');
    })


    // When hidding the modal clear form
    $('.modal').on('hidden.bs.modal', function() {
        // Clear values
        clearFormValues();

        // Clear error messages
        clearFormErrors();
    });

    // On click save form
    $('#modal-plan-form').submit(function(e) {
        // Don't post the Form (we'll do it with AJAX)
        e.preventDefault();

        // Clear previous errors
        clearFormErrors();

        // Check if all fields are valid
        var error = false;
        if ($('#name').val() == '') {
            showFormError('#name', 'Name is required');
            error = true;
        }

        // If no errors in the from, trigger AJAX call to save data
        if (!error) {
            showLoader();
            $.ajax({
                method: (plan_id == 0 ? 'POST' : 'PATCH'),
                url: '/api/plan',
                dataType: 'json',
                data: {
                    'id': plan_id,
                    'name': $('#name').val()
                }
            }).done(function(data) {
                location.reload();
            }).fail(function(xhr) {
                var errors = xhr.responseJSON;
                for (error in errors) {
                    showFormError('#' + error, errors[error][0]);
                }
                hideLoader();
            });
        }
    });

    // Create new day in plan
    $('#modal-days-form').submit(function(e) {
        // Don't post the Form (we'll do it with AJAX)
        e.preventDefault();

        // Clear previous errors
        clearFormErrors();

        // Check if all fields are valid
        var error = false;
        if ($('#day-name').val() == '') {
            showFormError('#day-name', 'Name is required');
            error = true;
        }

        // If no errors in the from, trigger AJAX call to save data
        if (!error) {
            showLoader();
            $.ajax({
                method: 'POST',
                url: '/api/plan/day',
                dataType: 'json',
                data: {
                    'id': day_id,
                    'plan_id': plan_id,
                    'name': $('#day-name').val()
                }
            }).done(function(data) {
                clearFormValues();
                loadPlanDays();
            }).fail(function(xhr) {
                var errors = xhr.responseJSON;
                if (errors['name'] != undefined) {
                    showFormError('#day-name', errors['name'][0]);
                }
                hideLoader();
            });
        }
    });

    // Confirm before deleting user
    $('.plan-delete').click(function() {
        if (confirm('Are you sure you want to delete this plan and all it\'s information?')) {
            showLoader();
            $.ajax({
                method: 'DELETE',
                url: '/api/plan',
                dataType: 'json',
                data: {
                    'id': $(this).data('id')
                }
            }).done(function(data) {
                location.reload();
            });
        }
    });

    // Confirm before deleting a day
    $('#modal-days-list').on('click', '.btn-day-delete', function() {
        if (confirm('Are you sure you want to delete this day and all it\'s information?')) {
            showLoader();
            $.ajax({
                method: 'DELETE',
                url: '/api/plan/day',
                dataType: 'json',
                data: {
                    'id': $(this).data('id')
                }
            }).done(function(data) {
                loadPlanDays();
            }).always(function() {
                hideLoader();
            });
        }
    });

    // Show modal to add exercises
    $('#modal-days-list').on('click', '.btn-exercises-add', function() {
        day_id = $(this).data('id');

        $('#modal-days').modal('hide');
        $('#modal-exercises').modal('show');
    });

    // Add exercises to day
    $('#modal-exercises-form').submit(function(e) {
        // Don't post the Form (we'll do it with AJAX)
        e.preventDefault();

        showLoader();
        $.ajax({
            method: 'POST',
            url: '/api/plan/day/exercise',
            dataType: 'json',
            data: 'day_id=' + day_id + '&' + $(this).serialize()
        }).always(function() {
            $('#modal-exercises').modal('hide');
            loadPlanDays();
            $('#modal-days').modal('show');
            hideLoader();
        });
    });

    // Remove exercise from day
    $('#modal-days-list').on('click', '.btn-exercise-remove', function() {
        showLoader();
        $.ajax({
            method: 'DELETE',
            url: '/api/plan/day/exercise',
            dataType: 'json',
            data: {
                day_id: $(this).data('day'),
                exercise_id: $(this).data('exercise')
            }
        }).always(function() {
            loadPlanDays();
        });
    });
});

function loadPlanDays() {
    $('#modal-days-list').empty();
    if (plan_id > 0) {
        showLoader();
        $.ajax({
            method: 'GET',
            url: '/api/plan/day',
            dataType: 'json',
            data: {
                'plan_id': plan_id
            }
        }).done(function(data) {
            var content = '<h4>No days found</h4>';
            if (data.length > 0) {
                content = '';
                data.forEach(function(day) {
                    content += dayCardTemplate(day);
                });
            }
            $('#modal-days-list').html(content);
            $('[data-toggle="tooltip"]').tooltip();
        }).always(function() {
            hideLoader();
        })
    }
}

function dayCardTemplate(day) {
    var output = '<div class="card">';
    output += '<div class="card-header">' + day.name + ' ';
    output += '<button class="btn btn-exercises-add" data-toggle="tooltip" title="Add exercises" data-id="' + day.id + '"><span class="octicon octicon-plus"></span></button> ';
    output += '<button class="btn btn-day-delete" data-toggle="tooltip" title="Delete day" data-id="' + day.id + '"><span class="octicon octicon-trashcan"></span></button>';
    output += '</div>';
    output += '<div class="card-body">';
    output += '<ul>';
    day.exercises.forEach(function(exercise) {
        output += '<li>' + exercise.name + ' <button class="btn btn-sm btn-exercise-remove" data-exercise="' + exercise.id + '" data-day="' + day.id + '"><span class="octicon octicon-trashcan"></span></button></li>';
    });
    output += '</ul>';
    output += '</div>';
    output += '</div>';
    return output;
}