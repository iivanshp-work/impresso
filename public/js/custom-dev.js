const $window = $(window), $document = $(document);

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
$document.ready(function(){
    //submit signup form
    $document.on('submit', '#signup_form', function(e){
        e.preventDefault();
        let form = $(this);
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
    $document.on('submit', '#signin_form', function(e){
        e.preventDefault();
        let form = $(this);
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
    $document.on('click', '[data-validation-step]', function(e){
        e.preventDefault();
        let step = $(this).data('validation-step');
        let form = $('#validationForm');
        form.find('.validation__step').hide();
        if(form.find('#' + step).length){
            form.find('#' + step).show();
        }
    });

    function goToValidationStep(step){
        $('[data-validation-step="' + step + '"]').trigger('click');
    }

    // upload button click
    $document.on('change click', '[data-validation-send-file]', function(e){
        e.preventDefault();
        let $this = $(this), item = $this.parent(), btn = item.find('[data-validation-send-file-hidden]');
        btn.trigger('click');
    });

    // upload file so server
    $document.on('change', '[data-validation-send-file-hidden]', function(e){
        let $this = $(this), item = $this.parent(), btn = item.find('[data-validation-send-file]'),
            id = $this.data('image-id'), formData = new FormData(), targetLink = base_url + '/validation';

        //if ($this.data("busy")) return;
        $this.data("busy", true);
        loadingStart();

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
                if(response.has_error){
                    showError(response.message ? response.message : 'An error occurred. Please try again later.');
                }else{
                    if(response.image && response.image.url){
                        selector = '[data-validation-' + id + '-src]';
                        $(selector).attr('src', response.image.url);
                        if(id == 'photo_id'){
                            goToValidationStep('step3');
                        }else{
                            goToValidationStep('step5');
                        }
                    }else{
                        showError('An error occurred. Please try again later.');
                    }
                }
            },
            error: function(){
                showError('An error occurred. Please try again later.');
            },
            complete: function(){
                loadingEnd();
                $this.data("busy", false);
            }
        });
    });

    //final validation step, set user to pending validation
    $document.on('change click', '[data-validation-check]', function(e){
        let $this = $(this), targetLink = base_url + '/validation';
        let data = {
            action: 'check_validation'
        };
        //if ($this.data("busy")) return;
        $this.data("busy", true);
        loadingStart();

        $this.prop('disabled', true);

        $.ajax({
            url: targetLink,
            type: 'post',
            data: data,
            dataType: 'json',
            success: function(response){
                $this.prop('disabled', false);
                if(response.has_error){
                    showError(response.message ? response.message : 'An error occurred. Please try again later.');
                }else{
                    $('#clickThankYou').trigger('click');
                }
            },
            error: function(){
                showError('An error occurred. Please try again later.');
            },
            complete: function(){
                loadingEnd();
                $this.data("busy", false);
            }
        });
    });
    //validation profile end

    //feeds start

    //set search form type when switch between tabs and submit form
    $document.on('click', '[data-feeds-tab]', function(e){
        let type = $(this).data('ftype');
        $('[data-feeds-search-page]').val(1);
        $('[data-feeds-search-keyword]').val('');
        $('[data-feeds-search-type]').val(type);
        setTimeout(function(){
            $('[data-feeds-search-form]').submit();
        }, 100);
    });
    //submit form on change search field
    $document.on('input', '[data-feeds-search-keyword]', function(e){
        e.preventDefault();
        $('[data-feeds-search-page]').val(1);
        $(this).closest('[data-feeds-search-form]').submit();
    });
    //submit feed form
    $document.on('submit', '[data-feeds-search-form]', function(e){
        e.preventDefault();
        feedsLoadItems();
    });
    // general feed submit Load items function
    function feedsLoadItems(){
        let frm = $('[data-feeds-search-form]'), targetLink = base_url + '/feeds';
        let data = frm.serialize();
        let type = frm.find('[data-feeds-search-type]').val();
        let wrapper = $('.' + type + '-wrapper');
        //if (frm.data("busy")) return;
        frm.data("busy", true);
        loadingStart();

        frm.prop('disabled', true);

        $.ajax({
            url: targetLink,
            type: 'post',
            data: data,
            dataType: 'json',
            success: function(response){
                frm.prop('disabled', false);
                if(response.has_error){
                    showError(response.message ? response.message : 'An error occurred. Please try again later.');
                }else{
                    if (response.has_more) {
                        page = response.page || frm.find('[data-feeds-search-page]').val();
                        $('[data-feeds-search-page]').val((parseInt(page) + 1));
                    }
                    if(response.html){
                        if(response.page == 1){
                            wrapper.empty();
                        }
                        wrapper.append(response.html);
                        if(needloadmore || response.page == 1){
                            if (type == 'jobs') {
                                loadMoreJobs();
                            } else {
                                loadMoreProfessionals();
                            }
                        }
                    } else if (response.keyword) {
                        wrapper.empty();
                        wrapper.append("<div class='text-center'>No record found.</div>");
                    }
                }
            },
            error: function(){
                showError('An error occurred. Please try again later.');
            },
            complete: function(){
                loadingEnd();
                frm.data("busy", false);
            }
        });
    }

    var needloadmore = 0;
    //load more for jobs
    function loadMoreJobs() {
        $('[data-load-more-jobs]').each(function () {
            let element = $(this), container = $(this).parent(), win = $(window), busy = false, errors = 0, retry = 3;
            let frm = $('[data-feeds-search-form]'), targetLink = base_url + '/feeds';
            function error() {
                errors++;
                if (errors >= retry) unbind();
            }

            function unbind() {
                win.unbind('scroll resize orientationchange', check);
                needloadmore = 1;
            }

            function check() {
                let type = frm.find('[data-feeds-search-type]').val();
                if (type != 'jobs') return;
                if (container.offset().top + container.height() > win.scrollTop() + win.height()) return;
                if (busy) return;
                busy = true;
                loadingStart();
                $.ajax({
                    url: targetLink,
                    type: 'post',
                    data: frm.serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if (response.html) {
                            container.append(response.html);
                            element = container.find("[data-load-more-jobs]").last();
                            let page = response.page || frm.find('[data-feeds-search-page]').val();
                            $('[data-feeds-search-page]').val((parseInt(page) + 1));
                        } else error();

                        if (response.has_more) check();
                        else unbind();
                    },
                    error: error,
                    complete: function (response) {
                        busy = false;
                        loadingEnd();
                    }
                });
            }

            win.bind('scroll resize orientationchange', check);
            check();
        });
    }
    //load more for professionals
    function loadMoreProfessionals(){
        $('[data-load-more-professionals]').each(function(){
            let element = $(this), container = $(this).parent(), win = $(window), busy = false, errors = 0, retry = 3;
            let frm = $('[data-feeds-search-form]'), targetLink = base_url + '/feeds';
            function error(response){
                errors++;
                if(errors >= retry) unbind();
            }

            function unbind(){
                win.unbind('scroll resize orientationchange', check);
                needloadmore = 1;
            }

            function check(){
                let type = frm.find('[data-feeds-search-type]').val();
                if (type != 'professionals') return;
                if(container.offset().top + container.height() > win.scrollTop() + win.height()) return;
                if(busy) return;
                busy = true;
                loadingStart();
                $.ajax({
                    url: targetLink,
                    type: 'post',
                    data: frm.serialize(),
                    dataType: 'json',
                    success: function(response){
                        if(response.html){
                            container.append(response.html);
                            element = container.find("[data-load-more-professionals]").last();
                            let page = response.page || frm.find('[data-feeds-search-page]').val();
                            $('[data-feeds-search-page]').val((parseInt(page) + 1));
                        }else error();

                        if(response.has_more) check();
                        else unbind();
                    },
                    error: error,
                    complete: function(response){
                        busy = false;
                        loadingEnd();
                    }
                });
            }

            win.bind('scroll resize orientationchange', check);
            check();
        });
    }
    //default jobs check
    loadMoreJobs();
    //feeds end

    //profile start
    // show profile LetStartImpressing popup
    if($('#showFeedsLetStartImpressing').length){
        $('#showFeedsLetStartImpressing').trigger('click');
    }
    if($('#showPendingPopup').length){
        $('#showPendingPopup').trigger('click');
    }
    //profile end


});
