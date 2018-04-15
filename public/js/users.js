var user_id = 0; // 0 to create new user, other value to edit

$(function() {
    // Initialize date picker
    $('#birthdate').datepicker({
        format: 'dd/mm/yyyy'
    });

    // Show modal to create new user
    $('#user-create').click(function() {
        clearFormValues();
        $('#modal-user-title').text('Create New User');
        $('#modal-user').modal('show');
    });

    // Show modal to edit a user
    $('.user-edit').click(function() {
        // Put user data in modal
        user_id = $(this).data('id');
        $('#first-name').val($(this).data('first-name'));
        $('#last-name').val($(this).data('last-name'));
        $('#email').val($(this).data('email'));
        $('#birthdate').val($(this).data('birthdate'));
        $('#height').val($(this).data('height'));
        $('#weigth').val($(this).data('weigth'));

        // Show modal
        $('#modal-user-title').text('Edit User');
        $('#modal-user').modal('show');
    });

    // When hidding the modal clear form
    $('#modal-user').on('hidden.bs.modal', function() {
        // Clear values
        clearFormValues();

        // Clear error messages
        clearFormErrors();

        // Clear user_id
        user_id = 0;
    });

    // On click save form
    $('#modal-user-form').submit(function(e) {
        // Don't post the Form (we'll do it with AJAX)
        e.preventDefault();

        // Clear previous errors
        clearFormErrors();

        // Check if all fields are valid
        var error = false;
        if ($('#first-name').val() == '') {
            showFormError('#first-name', 'First name is required');
            error = true;
        }
        if ($('#last-name').val() == '') {
            showFormError('#last-name', 'Last name is required');
            error = true;
        }
        if ($('#email').val() == '') {
            showFormError('#email', 'E-mail is required');
            error = true;
        }
        if ($('#birthdate').val() == '') {
            showFormError('#birthdate', 'Birthdate is required');
            error = true;
        }
        if ($('#height').val() == '') {
            showFormError('#height', 'Height is required');
            error = true;
        }
        if ($('#weigth').val() == '') {
            showFormError('#weigth', 'Weigth is required');
            error = true;
        }

        // If no errors in the from, trigger AJAX call to save data
        if (!error) {
            showLoader();
            $.ajax({
                method: (user_id == 0 ? 'POST' : 'PATCH'),
                url: '/api/user',
                dataType: 'json',
                data: {
                    'id': user_id,
                    'first-name': $('#first-name').val(),
                    'last-name': $('#last-name').val(),
                    'email': $('#email').val(),
                    'birthdate': $('#birthdate').val(),
                    'height': $('#height').val(),
                    'weigth': $('#weigth').val()
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

    // Confirm before deleting user
    $('.user-delete').click(function() {
        if (confirm('Are you sure you want to delete this user and all it\'s information?')) {
            showLoader();
            $.ajax({
                method: 'DELETE',
                url: '/api/user',
                dataType: 'json',
                data: {
                    'id': $(this).data('id')
                }
            }).done(function(data) {
                location.reload();
            });
        }
    });

    // Show plans modal
    $('.user-plans').click(function() {
        // Load user's plans
        clearFormValues();
        user_id = $(this).data('id');
        loadPlans();

        // Show modal
        $('#modal-plans').modal('show');
    });

    // Save user's plans
    $('#modal-plans-form').submit(function(e) {
        // Don't post the Form (we'll do it with AJAX)
        e.preventDefault();

        showLoader()
        $.ajax({
            method: 'POST',
            url: '/api/user/plan',
            dataType: 'json',
            data: 'user_id=' + user_id + '&' + $(this).serialize()
        }).always(function() {
            $('#modal-plans').modal('hide');
            hideLoader();
        });
    });
});

function loadPlans() {
    showLoader();
    $.ajax({
        method: 'GET',
        url: '/api/user/plan',
        dataType: 'json',
        data: {
            'id': user_id
        }
    }).done(function(data) {
        data.forEach(function(plan) {
            $('#plan-' + plan.id).prop('checked', true);
        });
    }).always(function() {
        hideLoader();
    });
}