var $window = $(window), $document = $(document);

function showError(title, message) {
    title = title || 'Error!';
    message = message || '';
    $('#customValidateSuccess .custom-title').text(title);
    $('#customValidateSuccess .custom-message').html(message);
    $('.customValidateSuccess').click().trigger('click');
}
function showSuccess(title, message) {
    title = title || 'Success!';
    message = message || '';
    $('#customValidateError .custom-title').text(title);
    $('#customValidateError .custom-message').html(message);
    $('.customValidateError').click().trigger('click');
}
function loadingStart() {
    $('#loading-full').show();
}

function loadingEnd() {
    $('#loading-full').hide();
}

$(document).ready(function() {
    $(document).on('submit', '#signup_form', function (e) {
        e.preventDefault();
        var form = $(this);
        //if (form.data("busy")) return;
        form.data("busy", true);
        loadingStart();
        $.ajax({
            url: form.attr("action"),
            type: 'post',
            dataType: 'json',
            data: form.serialize(),
            success: function (response) {
                if(response.has_error) {
                    showError('Oops, we had an error!', 'Please try again later.');
                } else {
                    showSuccess('Success!', 'Success.');
                }
            },
            error: function () {
                showError('Oops, we had an error!', 'Please try again later.');
            },
            complete: function () {
                loadingEnd();
                btn.data("busy", false);
            }
        });
    });
});
