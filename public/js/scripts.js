$(function() {
    $('[data-toggle="tooltip"]').tooltip();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

function showLoader() {
    $('#overlay-loading').css({ 'display' : 'flex' });
}

function hideLoader() {
    $('#overlay-loading').hide();
}

function showFormError(selector, message) {
    $(selector).addClass('is-invalid');
    $(selector).parent().find('.invalid-feedback').remove();
    $(selector).parent().append('<div class="invalid-feedback">' + message + '</div>');
}

function clearFormValues() {
    $('[type="text"]').val('');
    $('[type="checkbox"]').prop('checked', false);
}

function clearFormErrors() {
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();
}