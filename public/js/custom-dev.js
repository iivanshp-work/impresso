var $window = $(window), $document = $(document);

//default error popup
function showError(message, title){
    title = title || 'Error!';
    message = message || '';
    $('#customValidateSuccess .custom-title').text(title);
    $('#customValidateSuccess .custom-message').html(message);
    $('.customValidateSuccess').click().trigger('click');
}

//default success popup
function showSuccess(message, title){
    title = title || 'Success!';
    message = message || '';
    $('#customValidateError .custom-title').text(title);
    $('#customValidateError .custom-message').html(message);
    $('.customValidateError').click().trigger('click');
}

function redirect(location){
    location = location || base_url;
    window.location = location;
}

function loadingStart(){
    $('#loading-full').show();
}

function loadingEnd(){
    $('#loading-full').hide();
}

/**
 * Add CSRF token to any AJAX request header
 */
$.ajaxSetup({
    headers: {
        'X-Csrf-Token': $('meta[name="csrf-token"]').attr('content')
    }
});

//start function
$(document).ready(function(){
    //submit signup form
    $(document).on('submit', '#signup_form', function(e){
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
            success: function(response){
                if(response.has_error){
                    showError(response.message ? response.message : 'An error occurred. Please try again later.');
                }else{
                    redirect(response.redirect);
                }
            },
            error: function(){
                showError('An error occurred. Please try again later.');
            },
            complete: function(){
                loadingEnd();
                form.data("busy", false);
            }
        });
    });

    //submit signin form
    $(document).on('submit', '#signin_form', function(e){
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
            success: function(response){
                if(response.has_error){
                    showError(response.message ? response.message : 'An error occurred. Please try again later.');
                }else{
                    redirect(response.redirect);
                }
            },
            error: function(){
                showError('An error occurred. Please try again later.');
            },
            complete: function(){
                loadingEnd();
                form.data("busy", false);
            }
        });
    });

    //validation profile start
    $(document).on('click', '[data-validation-step]', function(e){
        e.preventDefault();
        var step = $(this).data('validation-step');
        var form = $('#validationForm');
        form.find('.validation__step').hide();
        if(form.find('#' + step).length){
            form.find('#' + step).show();
        }
    });

    $(document).on('change click', '[data-validation-send-file]', function(e){
       e.preventDefault();
        var $this = $(this), item = $this.parent(), btn = item.find('[data-validation-send-file-hidden]');
        btn.trigger('click');
    });
    $(document).on('change', '[data-validation-send-file-hidden]', function(e){
        var $this = $(this), item = $this.parent(), btn = item.find('[data-validation-send-file]'),
            id = $this.data('image-id'), formData = new FormData(), targetLink = base_url + '/validation';
        btn.prop('disabled', true);
        $this.prop('disabled', true);
        $this.after('<span class="spinner base-indent-left"></span>');
        formData.append('action', 'upload');
        formData.append('id', id);
        formData.append('file', $this.get(0).files[0]);

        $.ajax({
            url: targetLink,
            type: 'post',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response){
                btn.prop('disabled', false);
                $this.prop('disabled', false);
                item.find('.spinner').remove();
                if(response.error){
                    btn.after('<div class="alert alert-small alert-error base-indent-top">' + response.error + '</div>');
                    setTimeout(function(){
                        item.find('.alert-error').remove();
                    }, 3000);
                }else{
                    var imageUrlInput = $('[data-script-segment-image-url]', item),
                        imageUrl = imageUrlInput.data('scriptSegmentImageUrl') + response.image;
                    imageUrlInput.val(imageUrl);
                    $('.image-preview', item).show().find('img').attr('src', imageUrl);
                }
            }
        });
    });


});
