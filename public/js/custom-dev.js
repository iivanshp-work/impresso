const $window = $(window), $document = $(document);

//default error popup
function showError(message, title, callback){
    title = title || 'Error!';
    message = message || '';
    $('#customValidateSuccess .custom-title').text(title);
    $('#customValidateSuccess .custom-message').html(message);
    $('.customValidateSuccess').click().trigger('click');
    $('#customValidateSuccess [data-callback-button]').on('click', function(e){
        e.preventDefault();
        if(callback && typeof (callback) === "function"){
            callback();
        }else{
            $('.customValidateSuccess .close-modal').trigger('click');
        }
    });
}

//default success popup
function showSuccess(message, title, callback){
    title = title || 'Success!';
    message = message || '';
    $('#customValidateError .custom-title').text(title);
    $('#customValidateError .custom-message').html(message);
    $('.customValidateError').click().trigger('click');
    $('#customValidateError [data-callback-button]').on('click', function(e){
        e.preventDefault();
        if(callback && typeof (callback) === "function"){
            callback();
        }else{
            $('.customValidateError .close-modal').trigger('click');
        }
    });
}

//default success popup
function showConfirm(message, title, callback, callbackBtnText){
    title = title || 'Confirm!';
    message = message || '';
    callbackBtnText = callbackBtnText || 'Continue';
    $('#customValidateConfirm .custom-title').text(title);
    $('#customValidateConfirm .custom-message').html(message);
    $('#customValidateConfirm .custom-button').text(callbackBtnText);
    $('.customValidateConfirm').click().trigger('click');
    $('#customValidateConfirm [data-callback-button]').on('click', function(e){
        e.preventDefault();
        if(callback && typeof (callback) === "function"){
            callback();
        }else{
            $('.customValidateConfirm .close-modal').trigger('click');
        }
    })
}

//redirect
function redirect(location){
    location = location || base_url;
    window.location = location;
}

//loadingStart
function loadingStart(){
    $('#loading-full').show();
}

//loadingEnd
function loadingEnd(){
    $('#loading-full').hide();
}

//createCookie
function createCookie(name, value, days){
    if(days){
        let date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    }else{
        var expires = "";
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

//readCookie
function readCookie(name){
    let nameEQ = name + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++){
        let c = ca[i];
        while(c.charAt(0) == ' ') c = c.substring(1, c.length);
        if(c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

//Add CSRF token to any AJAX request header
$.ajaxSetup({
    headers: {
        'X-Csrf-Token': $('meta[name="csrf-token"]').attr('content')
    }
});

//start function
$document.ready(function(){
    // allow location start
    function apiGeolocationSuccess(position){
        createCookie("geolat", position.coords.latitude, 1);
        createCookie("geolon", position.coords.longitude, 1);
        saveGeoData(position.coords.latitude, position.coords.longitude);
    };

    //get geo location based on user geolocale
    function tryAPIGeolocation(){
        jQuery.post("https://www.googleapis.com/geolocation/v1/geolocate?key=" + google_api_key, function(success){
            apiGeolocationSuccess({coords: {latitude: success.location.lat, longitude: success.location.lng}});
        }).fail(function(err){
            showError("API Geolocation error!");
        });
    };

    //save location in db
    function saveGeoData(latitude, longitude){
        loadingStart();
        let targetLink = base_url + '/save-geo-data';
        $.ajax({
            url: targetLink,
            type: 'post',
            data: {lat:latitude, lon: longitude},
            dataType: 'json',
            success: function(response){
                if($('#allowLocationAccess').length){
                    $('#allowLocationAccess .close-modal').trigger('click');
                }
                if($('.user__info .location_title_field').length){
                    $('.user__info .location_title_field').text(response.user_address);
                }

            },
            error: function(){
                showError("API Geolocation error!");
            },
            complete: function(){
                loadingEnd();
            }
        });
    }

    //browserGeolocationSuccess
    function browserGeolocationSuccess(position){
        createCookie("geolat", position.coords.latitude, 1);
        createCookie("geolon", position.coords.longitude, 1);
        saveGeoData(position.coords.latitude, position.coords.longitude);
    };

    //browserGeolocationSuccess
    function browserGeolocationFail(error){
        switch(error.code){
            case error.TIMEOUT:
                tryAPIGeolocation();
                break;
            case error.PERMISSION_DENIED:
                if(error.message.indexOf("Only secure origins are allowed") == 0){
                    tryAPIGeolocation();
                }
                break;
            case error.POSITION_UNAVAILABLE:
                console.log("Browser geolocation error !\n\nPosition unavailable.");
                tryAPIGeolocation();
                break;
        }
    };

    //tryGeolocation based on navigator
    function tryGeolocation(){
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(
                browserGeolocationSuccess,
                browserGeolocationFail,
                {maximumAge: 50000, timeout: 20000, enableHighAccuracy: true});
        }
    };

    //show allow location popup when user loggedin and not had location info
    if (user_id) {
        if ($('.allowLocationAccess').length) {
            $('.allowLocationAccess').trigger('click');
            $('[data-allow-location]').on('click change', function (e) {
                e.preventDefault();
                tryGeolocation();
            });
        } else if (!readCookie('geolat') && !readCookie('geolon')) {
            //update location every day
            tryGeolocation();
        }
    }
    // allow location end

    //submit signup form
    $document.on('submit', '#signup_form', function(e){
        e.preventDefault();
        let form = $(this);
        if (form.data("busy")) return;
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
        if (form.data("busy")) return;
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
        let reader = new FileReader(), file = $this.get(0).files[0];

        reader.onloadend = function () {
            let selector = '[data-validation-' + id + '-src]';
            var img = new Image();
            img.onload = function() {
                if (this.width > this.height) {
                    $(selector).removeClass("vert_image");
                    var width = $window.width() > 370 ? 345 : 290;
                    var height = (width * this.height) / this.width;
                    $(selector).parent().css('height', height);
                    $(selector).parent().css('width', width);
                } else {
                    $(selector).addClass("vert_image");
                    var height = $window.width() > 370 ? 194 : 166;
                    var width = (height * this.width) / this.height;
                    $(selector).parent().css('height', height);
                    $(selector).parent().css('width', width);
                }
            }
            let src = reader.result;
            img.src = src;
            $(selector).attr('src', src);
            if(id == 'photo_id'){
                goToValidationStep('step3');
            }else{
                goToValidationStep('step5');
            }
        }
        if (file) {
            reader.readAsDataURL(file);
        } else {
            if(id == 'photo_id'){
                goToValidationStep('step2');
            }else{
                goToValidationStep('step4');
            }
        }

        if ($this.data("busy")) return;
        $this.data("busy", true);
        loadingStart();

        btn.prop('disabled', true);
        $this.prop('disabled', true);
        $this.after('<span class="spinner base-indent-left"></span>');
        formData.append('action', 'upload');
        formData.append('id', id);
        formData.append('file', file);

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
                        /*if(id == 'photo_id'){
                            goToValidationStep('step3');
                        }else{
                            goToValidationStep('step5');
                        }*/
                    }else{
                        if(id == 'photo_id'){
                            goToValidationStep('step2');
                        }else{
                            goToValidationStep('step4');
                        }
                        showError('An error occurred. Please try again later.');
                    }
                }
            },
            error: function(){
                if(id == 'photo_id'){
                    goToValidationStep('step2');
                }else{
                    goToValidationStep('step4');
                }
                showError('An error occurred. Please try again later.');
            },
            complete: function(){
                loadingEnd();
                $this.data("busy", false);
                btn.prop('disabled', false);
                $this.prop('disabled', false);
            }
        });
    });

    //final validation step, set user to pending validation
    $document.on('change click', '[data-validation-check]', function(e){
        let $this = $(this), targetLink = base_url + '/validation';
        let data = {
            action: 'check_validation'
        };
        if ($this.data("busy")) return;
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

    //submit form on change search field, avoid many requests on keypress
    function throttle(f, delay){
        let timer = null;
        return function(){
            let context = this, args = arguments;
            clearTimeout(timer);
            timer = window.setTimeout(function(){
                    f.apply(context, args);
                },
                delay || 500);
        };
    }
    //submit search form on change search keyword
    $document.on('input', '[data-feeds-search-keyword]', throttle(function(){
            $('[data-feeds-search-page]').val(1);
            $(this).closest('[data-feeds-search-form]').submit();
        }, 1000)
    );

    //submit search form on press enter
    $document.on('keypress', '[data-feeds-search-keyword]', function(e) {
        if(e.which == 13) {
            e.preventDefault();
            $('[data-feeds-search-page]').val(1);
            $(this).closest('[data-feeds-search-form]').submit();
        }
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
        if (frm.data("busy")) return;
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
                    if(response.has_more){
                        page = response.page || frm.find('[data-feeds-search-page]').val();
                        $('[data-feeds-search-page]').val((parseInt(page) + 1));
                    }
                    if(response.html){
                        if(response.page == 1){
                            wrapper.empty();
                        }
                        wrapper.append(response.html);
                        if(needloadmore || response.page == 1){
                            if(type == 'jobs'){
                                loadMoreJobs();
                            }else{
                                loadMoreProfessionals();
                            }
                        }
                    }else if(response.keyword){
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
    function loadMoreJobs(){
        $('[data-load-more-jobs]').each(function(){
            let element = $(this), container = $(this).parent(), win = $(window), busy = false, errors = 0, retry = 3;
            let frm = $('[data-feeds-search-form]'), targetLink = base_url + '/feeds';

            function error(){
                errors++;
                if(errors >= retry) unbind();
            }

            function unbind(){
                win.unbind('scroll resize orientationchange', check);
                needloadmore = 1;
            }

            function check(){
                let type = frm.find('[data-feeds-search-type]').val();
                if(type != 'jobs') return;
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
                            container.find('[data-page="' + response.page + '"]').remove();
                            container.append(response.html);
                            element = container.find("[data-load-more-jobs]").last();
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
                if(type != 'professionals') return;
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
                            container.find('[data-page="' + response.page + '"]').remove();
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

    //edit profile start
    $document.on('submit', '[data-edit-profile-form]', function(e){
        e.preventDefault();
        let form = $(this);
        if (form.data("busy")) return;
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
                    showSuccess(response.message);
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

    //change fields in two ways start
    $document.on('change', '[name="company_title_top"]', function(e){
        let val = $(this).val();
        $(this).closest("form").find('[name="company_title"]').val(val);
    })
    $document.on('change', '[name="company_title"]', function(e){
        let val = $(this).val();
        $(this).closest("form").find('[name="company_title_top"]').val(val);
    });
    $document.on('change', '[name="job_title_top"]', function(e){
        let val = $(this).val();
        $(this).closest("form").find('[name="job_title"]').val(val);
    })
    $document.on('change', '[name="job_title"]', function(e){
        let val = $(this).val();
        $(this).closest("form").find('[name="job_title_top"]').val(val);
    });
    //change fields in two ways end

    // upload button click
    $document.on('change click', '[data-edit-profile-send-photo]', function(e){
        e.preventDefault();
        let $this = $(this), itemForm = $this.closest('[data-edit-profile-form]'),
            btn = itemForm.find('[data-edit-profile-send-photo-hidden]');
        btn.trigger('click');
    });

    // upload file so server
    $document.on('change', '[data-edit-profile-send-photo-hidden]', function(e){
        let $this = $(this), item = $this.parent(), btn = item.find('[data-validation-send-file]'),
            id = $this.data('image-id'), formData = new FormData(), targetLink = base_url + '/profile/edit';

        if ($this.data("busy")) return;
        $this.data("busy", true);
        loadingStart();

        btn.prop('disabled', true);
        $this.prop('disabled', true);
        $this.after('<span class="spinner base-indent-left"></span>');
        formData.append('action', 'upload_photo');
        formData.append('id', id);
        formData.append('file', $this.get(0).files[0]);
        if($this.get(0).files[0]){
            let file = $this.get(0).files[0];
            let ext = file.name.split(".");
            let availableExtensions = ["jpg", "jpeg", "png"];
            let notAvailable = false;
            ext = ext[ext.length - 1].toLowerCase();
            if($.inArray(ext, availableExtensions) == -1){
                notAvailable = true;
            }
            if(notAvailable){
                $this.data("busy", false);
                btn.prop('disabled', false);
                $this.prop('disabled', false);
                showError('Selected file has not allowed extension.(Allowed JPG, JPEG, PNG)', 'Error!', function(){
                    $('[data-edit-profile-send-photo]').trigger('click');
                });
                return;
            }
        }

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
                        if(response.image.crop_url){
                            response.image.url = response.image.crop_url;
                        }
                        selector = '[data-edit-profile-src]';
                        $(selector).attr('src', response.image.url);
                        $('[data-photo-hidden]').val(response.image.id);
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
                btn.prop('disabled', false);
                $this.prop('disabled', false);
            }
        });
    });

    //request validation data
    var requestValidationData = {};
    var requestItem = null;

    // add new education
    $document.on('click change', '[data-education-wrapper] [data-add-new-education]', function(e){
        e.preventDefault();
        let template = $('[data-education-wrapper] [data-education-template]').html();
        template = $(template.replace(/%KEY%/g, Date.now()));
        let wrapper = $('[data-education-wrapper]');
        wrapper.append(template);
    });

    //remove education
    $document.on('click change', '[data-education-wrapper] [data-education-item] [data-remove-item]', function(e){
        e.preventDefault();
        let $this = $(this);
        let id = $this.data('id');
        let item = $this.closest('[data-education-item]');
        showConfirm('Are you sure, you want to remove this item?', 'Remove', function(){
            item.remove();
        });
    });

    //click on request-validation-item
    $document.on('click change', '[data-education-wrapper] [data-education-item] [data-request-validation-item]', function(e){
        e.preventDefault();
        let $this = $(this);
        let id = $this.data('id');
        let item = $this.closest('[data-education-item]');

        //validete title and speciality
        if(!$('[data-title-field]', item).val() || !$('[data-speciality-field]', item).val()){
            let message = '';
            if(!$('[data-title-field]', item).val()){
                message += 'School Name is empty.<br>';
            }
            if(!$('[data-speciality-field]', item).val()){
                message += 'Speciality is empty.<br>';
            }
            showError(message);
            return;
        }

        let data = {
            id: $('[data-id-field]', item).val(),
            title: $('[data-title-field]', item).val(),
            speciality: $('[data-speciality-field]', item).val(),
            type: 'education',
            action: 'request_validation'
        };
        requestValidationData = data;
        clearUploadForm();
        openProfileEditPopup('upload');
    });

    // add new certificate
    $document.on('click change', '[data-certificate-wrapper] [data-add-new-certificate]', function(e){
        e.preventDefault();
        let template = $('[data-certificate-wrapper] [data-certificate-template]').html();
        template = $(template.replace(/%KEY%/g, Date.now()));
        let wrapper = $('[data-certificate-wrapper]');
        wrapper.append(template);
    });

    //remove certificate
    $document.on('click change', '[data-certificate-wrapper] [data-certificate-item] [data-remove-item]', function(e){
        e.preventDefault();
        let $this = $(this);
        let id = $this.data('id');
        let item = $this.closest('[data-certificate-item]');
        showConfirm('Are you sure, you want to remove this item? This action cannot be undone.', 'Remove', function(){
            item.remove();
        });
    });

    //click on request-validation-item
    $document.on('click change', '[data-certificate-wrapper] [data-certificate-item] [data-request-validation-item]', function(e){
        e.preventDefault();
        let $this = $(this);
        let id = $this.data('id');
        let item = $this.closest('[data-certificate-item]');

        //validete title and speciality
        if(!$('[data-title-field]', item).val()){
            let message = '';
            if(!$('[data-title-field]', item).val()){
                message += 'Certificate Name.<br>';
            }
            showError(message);
            return;
        }

        let data = {
            id: $('[data-id-field]', item).val(),
            title: $('[data-title-field]', item).val(),
            type: 'certificate',
            action: 'request_validation'
        };
        requestValidationData = data;
        requestItem = item;
        clearUploadForm();
        openProfileEditPopup('upload');
    });

    //cleanup upload form
    function clearUploadForm(){
        $('#edit_profile_upload_attach_form [name="url"]').val('').trigger('change');
        $('#edit_profile_upload_attach_form [name="files"]').val('');
        $('#edit_profile_upload_attach_form .default_title').show();
        $('#edit_profile_upload_attach_form .selected_files_title').hide().find('.files_text').text('');
    }

    //isUrlValid
    function isUrlValid(value){
        let res = value.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
        if(res == null)
            return false;
        else
            return true;
    }

    //open browse window
    $('[data-edit-profile-send-popup-files]').on('click change', function(e){
        e.preventDefault();
        let $this = $(this), itemForm = $this.closest('#edit_profile_upload_attach_form'),
            btn = itemForm.find('[data-edit-profile-send-popup-files-hidden]');
        btn.trigger('click');
    });

    //open remove upload file popup
    $('#edit_profile_upload_attach_form [data-remove-selected-files]').on('click change', function(e){
        e.preventDefault();
        openProfileEditPopup('upload-remove');
    });

    //removed previous files
    $('[data-profile-edit-upload-remove-btn]').on('click change', function(e){
        e.preventDefault();
        clearUploadForm();
        closeProfileEditPopup('upload-remove');
        openProfileEditPopup('upload');
    });

    //close remove upload popup
    $('[data-profile-edit-upload-remove-btn-cancel]').on('click change', function(e){
        e.preventDefault();
        openProfileEditPopup('upload');
    });

    // upload file so server
    $('[data-edit-profile-send-popup-files-hidden]').on('change', function(e){
        let $this = $(this), item = $this.parent(), btn = item.find('[data-edit-profile-send-popup-files]'),
            formData = new FormData(), targetLink = base_url + '/profile/edit';
        let availableExtensions = ["jpg", "jpeg", "png", "pdf", "doc", "docx"];
        let files = $this.get(0).files;
        let notAvailable = false;
        let selectedFiles = '';
        $('#edit_profile_upload_attach_form .default_title').show();
        $('#edit_profile_upload_attach_form .selected_files_title').hide().find('.files_text').text('');
        $('#edit_profile_upload_attach_form [data-files-value]').val('');
        if(files.length){
            selectedFiles += files.length + ' file' + (files.length > 1 ? 's ' : ' ') + 'selected:';
            $.each(files, function(index, file){
                let ext = file.name.split(".");
                ext = ext[ext.length - 1].toLowerCase();
                if($.inArray(ext, availableExtensions) == -1){
                    notAvailable = true;
                }
                if(index == 0){
                    selectedFiles += '“' + file.name + '...”';
                }
            });
            if(notAvailable){
                showError('Selected file has not allowed extension.', 'Error!', function(){
                    openProfileEditPopup('upload');
                });
                return;
            }
        }else{
            showError('No files selected.', 'Error!', function(){
                openProfileEditPopup('upload');
            });
            return;
        }
        if ($this.data("busy")) return;
        $this.data("busy", true);
        loadingStart();

        btn.prop('disabled', true);
        $this.prop('disabled', true);
        $this.after('<span class="spinner base-indent-left"></span>');
        formData.append('action', 'upload_profile_files');
        $.each($this.get(0).files, function(index, file){
            formData.append('files[]', file);
        });

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
                    if(response.files){
                        $('#edit_profile_upload_attach_form .default_title').hide();
                        $('#edit_profile_upload_attach_form .selected_files_title').show().find('.files_text').text(selectedFiles);
                        $('#edit_profile_upload_attach_form [data-files-value]').val(response.files);
                    }else{
                        showError('An error occurred. Please try again later.', 'Error', function(){
                            openProfileEditPopup('upload');
                        });
                    }
                }
            },
            error: function(){
                showError('An error occurred. Please try again later.', 'Error', function(){
                    openProfileEditPopup('upload');
                });
            },
            complete: function(){
                loadingEnd();
                $this.data("busy", false);
                btn.prop('disabled', false);
                $this.prop('disabled', false);
            }
        });
    });

    //click on upload button: require url or files
    $('[data-profile-edit-upload-btn]').on('click change', function(e){
        e.preventDefault();
        let form = $('#edit_profile_upload_attach_form');
        //validete url or files
        if(!$('[name="url"]', form).val() && !$('[name="files"]', form).val()){
            let message = 'URL or files are required.';
            closeProfileEditPopup('upload');
            showError(message, 'Error', function(){
                openProfileEditPopup('upload');
            });
            return;
        }else if($('[name="url"]', form).val() && !isUrlValid($('[name="url"]', form).val())){
            let message = 'URL is invalid.';
            closeProfileEditPopup('upload');
            showError(message, 'Error', function(){
                openProfileEditPopup('upload');
            });
            return;
        }

        requestValidationData.url = $('[name="url"]', form).val();
        requestValidationData.files = $('[name="files"]', form).val();
        openProfileEditPopup('validate');
    });

    //send request to server
    $('[data-profile-edit-validate-btn]').on('click change', function(e){
        e.preventDefault();
        let btn = $(this), targetLink = base_url + '/profile/edit';
        //send request to server
        if (btn.data("busy")) return;
        btn.data("busy", true);
        loadingStart();
        $.ajax({
            url: targetLink,
            type: 'post',
            dataType: 'json',
            data: requestValidationData,
            success: function(response){
                if(response.has_error){
                    showError(response.message ? response.message : 'An error occurred. Please try again later.', 'Error', function(){
                        closeProfileEditPopup('validate');
                    });
                }else{
                    if(response.no_xims){
                        openProfileEditPopup('validate-not_xims');
                    }else if(response.id){
                        openProfileEditPopup('validate-success');
                        requestValidationData = {};
                        if (requestItem) {
                            requestItem.find('[data-request-validation-item]').hide();
                            requestItem.find('.user__validated').removeClass('hide');
                            requestItem.find('[data-id-field]').val(response.id);
                            requestItem.find('input[type="text"]').attr('disabled', 'disabled');
                        }
                    }

                }
            },
            error: function(){
                showError('An error occurred. Please try again later.');
            },
            complete: function(){
                loadingEnd();
                btn.data("busy", false);
            }
        });
    });

    //back to prev step
    $('[data-profile-edit-validate-btn-cancel]').on('click change', function(e){
        e.preventDefault();
        openProfileEditPopup('upload');
    });

    //function to open needed edit profile popup
    function openProfileEditPopup(id){
        let selector = '[btn-' + id + '-popup]';
        if($(selector).length){
            $(selector).click().trigger('click');
        }
    }

    //function to open needed edit profile popup
    function closeProfileEditPopup(id){
        let selector = '[data-' + id + '-popup]';
        if($(selector).length){
            $(selector + ' .close-modal').trigger('click');
        }
    }
    //edit profile end

    //edit settings start
    $document.on('submit', '[data-edit-settings-form]', function(e){
        e.preventDefault();
        let form = $(this);
        let disabled = form.find(':input:disabled').removeAttr('disabled');
        let data = form.serialize();
        disabled.attr('disabled', 'disabled');
        if (form.data("busy")) return;
        form.data("busy", true);
        loadingStart();
        $.ajax({
            url: form.attr("action"),
            type: 'post',
            dataType: 'json',
            data: data,
            success: function(response){
                if(response.has_error){
                    showError(response.message ? response.message : 'An error occurred. Please try again later.');
                }else{
                    showSuccess(response.message);
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
    //edit settings end

    //credits settings start
    $document.on('click change', '[data-settings-buy-credits]', function(e){
        e.preventDefault();
        let btn = $(this), targetLink = base_url + '/settings/credits/checkout';
        let data = btn.closest('form').serialize();
        if (btn.data("busy")) return;
        btn.data("busy", true);
        loadingStart();
        $.ajax({
            url: targetLink,
            type: 'post',
            dataType: 'json',
            data: data,
            success: function(response){
                if(response.has_error){
                    showError(response.message ? response.message : 'An error occurred. Please try again later.');
                }else{
                    showSuccess(response.message);
                    btn.closest('form').find('[data-required-fields]').val('');
                }
            },
            error: function(){
                showError('An error occurred. Please try again later.');
            },
            complete: function(){
                loadingEnd();
                btn.data("busy", false);
            }
        });
    });

    //mask for checkout fields
    if ($('.checkout-page').length) {
        $('#checkout_settings_form [name="card_no"]').mask("0000 0000 0000 0000", {placeholder: "____ ____ ____ ____", clearIfNotMatch: true});
        $('#checkout_settings_form [name="cvv"]').mask("0000", {placeholder: "___"});
        $('#checkout_settings_form [name="exp_month"]').mask("00", {placeholder: "MM", clearIfNotMatch: true});
        $('#checkout_settings_form [name="exp_year"]').mask("00", {placeholder: "YY", clearIfNotMatch: true});
    }
    //credits settings end

    //share btn start
    $document.on('click change', '[data-share-open-btn]', function(e){
        e.preventDefault();
        $('.sharePopup').click().trigger('click');
    });
    $('[data-share-btn]').on('click change', function(e){
        e.preventDefault();
        share();
    });

    function share() {
        if (navigator.share) {
            navigator.share({
                title: 'Impresso',
                url: 'https://codepen.io/ayoisaiah/pen/YbNazJ'
            }).then(() => {
                saveShare();
            }).catch(() => {
                showError('Error while share');
            });
        } else {
            openCustomSharePopup();
        }
    }

    function openCustomSharePopup() {
        $('[data-copy-share-link]').text("Copy Link");
        $('.customSharePopup').click().trigger('click');
    }

    $('[data-open-share-link]').on('click change', function(e){
        saveShare();
    });

    $('[data-copy-share-link]').on('click change', function(e){
        e.preventDefault();
        let text = $(this).parent().find('[data-share-link]').text();
        $(this).text("Copied");
        copyToClipboard(text);
        saveShare();
    });

    function copyToClipboard(text) {
        Clipboard.copy(text);
    }

    window.Clipboard = (function(window, document, navigator) {
        var textArea,
            copy;

        function isOS() {
            return navigator.userAgent.match(/ipad|iphone/i);
        }

        function createTextArea(text) {
            textArea = document.createElement('textArea');
            textArea.value = text;
            document.body.appendChild(textArea);
        }

        function selectText() {
            var range,
                selection;

            if (isOS()) {
                range = document.createRange();
                range.selectNodeContents(textArea);
                selection = window.getSelection();
                selection.removeAllRanges();
                selection.addRange(range);
                textArea.setSelectionRange(0, 999999);
            } else {
                textArea.select();
            }
        }

        function copyToClipboard() {
            document.execCommand('copy');
            document.body.removeChild(textArea);
        }

        copy = function(text) {
            createTextArea(text);
            selectText();
            copyToClipboard();
        };

        return {
            copy: copy
        };
    })(window, document, navigator);

    function saveShare() {
        loadingStart();
        let targetLink = base_url + '/save-share';
        $.ajax({
            url: targetLink,
            type: 'post',
            data: {'test':1},
            dataType: 'json',
            success: function(response){
                $('.shareSuccessPopup').click().trigger('click');
            },
            error: function(){
                showError("Share error!");
            },
            complete: function(){
                loadingEnd();
            }
        });
    }
    //share btn end

});
