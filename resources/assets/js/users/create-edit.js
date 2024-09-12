'use strict'

document.addEventListener('turbo:load', loadUserCreateEditData)

function loadUserCreateEditData() {

    if (!$("#userDob").length) {
        return;
    }

    $("#userDob").flatpickr({
        maxDate: new Date(),
        locale: $(".userCurrentLanguage").val(),
    });

    if (!$('.userDoctorDepartment').length) {
        return false;
    }

}

listenKeyup('#userFacebookUrl', function () {
    this.value = this.value.toLowerCase()
})
listenKeyup('#userTwitterUrl', function () {
    this.value = this.value.toLowerCase()
})
listenKeyup('#userInstagramUrl', function () {
    this.value = this.value.toLowerCase()
})
listenKeyup('#userLinkedInUrl', function () {
    this.value = this.value.toLowerCase()
})

listenClick('#btnUserSave', function () {
    if ($('.error-msg').text() !== '') {
        $('#phoneNumber').focus()
        return false
    }

    let facebookUrl = $('#userFacebookUrl').val()
    let twitterUrl = $('#userTwitterUrl').val()
    let instagramUrl = $('#userInstagramUrl').val()
    let linkedInUrl = $('#userLinkedInUrl').val()
    var isValid = true;

    let facebookExp = new RegExp(
        /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)facebook.[a-z]{2,3}\/?.*/i);
    let twitterExp = new RegExp(
        /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)twitter\.[a-z]{2,3}\/?.*/i);
    let instagramUrlExp = new RegExp(
        /^(https?:\/\/)?((w{2,3}\.)?)instagram.[a-z]{2,3}\/?.*/i);
    let linkedInExp = new RegExp(
        /^(https?:\/\/)?((w{2,3}\.)?)linkedin\.[a-z]{2,3}\/?.*/i);

    let facebookCheck = (facebookUrl == '' ? true : (facebookUrl.match(
        facebookExp) ? true : false))
    Lang.setLocale($('.userCurrentLanguage').val())
    if (!facebookCheck) {
        displayErrorMessage(Lang.get('js.please_enter_valid_facebook_url'))
        setTimeout(function () {
            $('#btnUserSave').removeAttr('disabled')
        }, 3000)
        isValid = false;
        return false;
    }
    let twitterCheck = (twitterUrl == '' ? true : (twitterUrl.match(twitterExp)
        ? true
        : false))
    if (!twitterCheck) {
        displayErrorMessage(Lang.get('js.please_enter_valid_twitter_url'))
        setTimeout(function () {
            $('#btnUserSave').removeAttr('disabled')
        }, 3000)
        isValid = false;
        return false;
    }
    let instagramCheck = (instagramUrl == '' ? true : (instagramUrl.match(
        instagramUrlExp) ? true : false))
    if (!instagramCheck) {
        displayErrorMessage(Lang.get('js.please_enter_valid_Instagram_url'))
        setTimeout(function () {
            $('#btnUserSave').removeAttr('disabled')
        }, 3000)
        isValid = false;
        return false;
    }
    let linkedInCheck = (linkedInUrl == '' ? true : (linkedInUrl.match(
        linkedInExp) ? true : false))
    if (!linkedInCheck) {
        displayErrorMessage(Lang.get('js.please_enter_valid_linkedin_url'))
        setTimeout(function () {
            $('#btnUserSave').removeAttr('disabled')
        }, 3000)
        isValid = false;
        return false;
    }

    if(isValid){
        $('#createUserForm, #editUserForm').submit();
    }
});

$('#createUserForm, #editUserForm').
    on('keyup keypress', function (e) {
        let keyCode = e.keyCode || e.which
        if (keyCode === 13) {
            e.preventDefault()
            return false
        }
    })

// $('#userDob').flatpickr({
//     maxDate: new Date(),
//     locale: $('.userCurrentLanguage').val(),
// })

listen('change', '#userProfileImage', function () {
    let extension = isValidDocument($(this), '#userValidationErrorsBox')
    if (!isEmpty(extension) && extension != false) {
        $('#userValidationErrorsBox').html('').hide()
        displayDocument(this, '#userPreviewImage', extension)
    }
})

window.isValidDocument = function (
    inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase()
    if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx']) ==
        -1) {
        $(inputSelector).val('')
        $(validationMessageSelector).
            html(
                Lang.get('js.image_must_be')).
            removeClass('display-none').show()

        setTimeout(function () {
            $(validationMessageSelector).slideUp(300)
        }, 5000)

        return false
    }
    $(validationMessageSelector).addClass('display-none')

    return ext
}

// listenSubmit('#createUserForm, #editUserForm', function () {
//     $('#btnUserSave').attr('disabled', true);
// });

listenClick('.remove-image', function () {
    defaultImagePreview('#userPreviewImage', 1)
})

if ($('#userRole').val() == 2) {
    $('.doctor_department').removeClass('d-none')
    $('#userDoctorDepartmentId').attr('required')
}

listenChange('#userRole', function () {
    let role = $(this).val()
    if (role == 2) {
        $('.doctor_department').removeClass('d-none')
        $('#userDoctorDepartmentId').attr('required')
    } else {
        $('.doctor_department').addClass('d-none')
        $('#userDoctorDepartmentId').removeAttr('required')
    }
})
