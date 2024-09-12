// document.addEventListener('turbo:load', loadConsultationData)
Livewire.hook("element.init", () => {
    $("#liveConsultationFilterStatusArr").select2({
        width: "100%",
    });
    loadConsultationData();
});
function loadConsultationData () {

    if (!$('#indexLiveConsultationUrl').length) {
        return
    }

    listenShownBsModal('#add_consulatation_modal', function () {
        $('.doctor-name,.patient-name,.consultation-type,.consultation-type-number,.change-status,.platform-type').
            select2({
                width: '100%',
                dropdownParent: ('#add_consulatation_modal'),
            })
    })

    listenShownBsModal('#edit_consulatation_modal', function () {
        $('.edit-doctor-name,.edit-patient-name,.edit-consultation-type,.edit-consultation-type-number,.edit-change-status').
            select2({
                width: '100%',
                dropdownParent: ('#edit_consulatation_modal'),
            })
    })

    $('#liveConsultationFilterStatusArr').select2({
        width: '100%',
    })

    $('.consultation-date').flatpickr({
        enableTime: true,
        defaultDate: new Date(),
        minDate: new Date(),
        dateFormat: 'Y-m-d H:i',
        locale: $('.userCurrentLanguage').val(),
    })

    $('.edit-consultation-date').flatpickr({
        enableTime: true,
        minDate: new Date(),
        dateFormat: 'Y-m-d H:i',
        locale: $('.userCurrentLanguage').val(),
    })

    $('.change-consultation-status').select2({
        width: '100%',
    })
}

listenHiddenBsModal('#add_consulatation_modal', function () {
    resetModalForm('#addConsultationForm', '#consultationErrorsBox')
    $('.consultation-type, .consultation-type-number').
        val('').
        trigger('change')
    $('select').each(function (index, element) {
        let drpSelector = '#' + $(this).attr('id')
        $(drpSelector).val('')
        $(drpSelector).prop('selectedIndex', 0).trigger('change')
    })
    $('#consultationTypeNumber').val(null).trigger('change')
    $('#consultationTypeNumber').append(
        $('<option selected="selected" value="">Select Type Number</option>'))
})
listenHiddenBsModal('#edit_consulatation_modal', function () {
    resetModalForm('#editConsultationForm', '#editConsultationErrorsBox')
})

let consultationPatientId = null
listenChange('.consultation-type, .edit-consultation-type', function () {
    changeConsultationTypeNumber(
        '.consultation-type-number, .edit-consultation-type-number',
        $(this).val(), consultationPatientId)
})

listenChange('.patient-name, .edit-patient-name', function () {
    if ($(this).val() !== '') {
        consultationPatientId = $(this).val()
        $('.consultation-type-number, .edit-consultation-type-number').empty()
        $('.consultation-type-number, .edit-consultation-type-number').
            append(
                '<option selected="selected" value="">'+Lang.get('js.select_type_number')+'</option>')
        $('.consultation-type, .edit-consultation-type').removeAttr('disabled')
    }
})

function changeConsultationTypeNumber (selector, id, consultationPatientId) {
    if ($(selector).val() !== '') {
        $.ajax({
            url: $('#indexLiveConsultationTypeNumber').val(),
            type: 'get',
            dataType: 'json',
            data: {
                consultation_type: id,
                patient_id: consultationPatientId,
            },
            success: function (data) {
                if (data.data.length !== 0) {
                    $(selector).empty()
                    $(selector).removeAttr('disabled')
                    $(selector).
                        append(
                            '<option selected="selected" value="">'+Lang.get('js.select_type_number')+'</option>')
                    $.each(data.data, function (i, v) {
                        $(selector).
                            append($('<option></option>').
                                attr('value', i).
                                text(v))
                    })
                    $('.consultation-type-number').select2({
                        width: '100%',
                        dropdownParent: $('#add_consulatation_modal'),
                    })
                    $('.edit-consultation-type-number').select2({
                        width: '100%',
                        dropdownParent: $('#edit_consulatation_modal'),
                    })
                } else {
                    $(selector).empty()
                    $(selector).
                        append(
                            '<option selected="selected" value="">'+Lang.get('js.select_type_number')+'</option>')
                    $(selector).prop('disabled', true)
                }
            },
        })
    }
    $(selector).empty()
    $(selector).prop('disabled', true)
    $(selector).append('<option>Select Type Number</option>')
}

listenSubmit('#addConsultationForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#consultationSave');
    loadingButton.button('loading');
    $('#consultationSave').attr('disabled', true);
    $('#consultationSave').text('Processing...');
    $.ajax({
        url: $('#indexLiveConsultationCreateUrl').val(),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#add_consulatation_modal').modal('hide');
                setTimeout(function () {
                    loadingButton.button('reset');
                }, 2500)
                $('#consultationSave').attr('disabled', false);
                $('#consultationSave').text('save');
                Livewire.dispatch('refresh')
            }
        },
        error: function (result) {
            printErrorMessage('#consultationErrorsBox', result);
            setTimeout(function () {
                loadingButton.button('reset');
            }, 2000)
            $('#consultationSave').attr('disabled', false);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    })
})

listenSubmit('#editConsultationForm', function (event) {
    event.preventDefault()
    let loadingButton = jQuery(this).find('#editConsultationSave');
    loadingButton.button('loading');
    $('#editConsultationSave').attr('disabled', true);
    $('#editConsultationSave').text('Processing...');
    let id = $('#liveConsultationId').val();
    $.ajax({
        url: $('#indexLiveConsultationUrl').val() + '/' + id,
        type: 'post',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#edit_consulatation_modal').modal('hide');
                // $('#liveConsultationTable').DataTable().ajax.reload(null, false);
                $('#editConsultationSave').attr('disabled', false);
                $('#editConsultationSave').text('Save');
                Livewire.dispatch('refresh')
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
            $('#editConsultationSave').attr('disabled', false);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    })
})

function renderConsultationData (id) {
    $.ajax({
        url: $('#indexLiveConsultationUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let liveConsultation = result.data
                $('#liveConsultationId').val(liveConsultation.id)
                $('.edit-consultation-title').
                    val(liveConsultation.consultation_title)
                // document.querySelector('.edit-consultation-date').
                //     _flatpickr.
                //     setDate(moment(liveConsultation.consultation_date).format('YYYY-MM-DD h:mm A'));
                $('.edit-consultation-date').
                    val(moment(liveConsultation.consultation_date).
                        format('YYYY-MM-DD h:mm A'))
                $('.edit-platform-type').
                    val(liveConsultation.platform_type).
                    trigger('change')
                $('.edit-consultation-duration-minutes').
                    val(liveConsultation.consultation_duration_minutes)
                $('.edit-patient-name').
                    val(liveConsultation.patient_id).
                    trigger('change')
                $('.edit-doctor-name').
                    val(liveConsultation.doctor_id).
                    trigger('change')
                $('.host-enable,.host-disabled').prop('checked', false)
                if (liveConsultation.host_video == 1) {
                    $(`input[name="host_video"][value=${liveConsultation.host_video}]`).
                        prop('checked', true)
                } else {
                    $(`input[name="host_video"][value=${liveConsultation.host_video}]`).
                        prop('checked', true)
                }
                $('.client-enable,.client-disabled').prop('checked', false)
                if (liveConsultation.participant_video == 1) {
                    $(`input[name="participant_video"][value=${liveConsultation.participant_video}]`).
                        prop('checked', true)
                } else {
                    $(`input[name="participant_video"][value=${liveConsultation.participant_video}]`).
                        prop('checked', true)
                }
                $('.edit-consultation-type').
                    val(liveConsultation.type).
                    trigger('change')
                setTimeout(function () {
                    $('.edit-consultation-type-number').
                        val(liveConsultation.type_number).
                        trigger('change')
                }, 1000)
                $('.edit-description').val(liveConsultation.description)
                $('#edit_consulatation_modal').modal('show')
                ajaxCallCompleted()
            }
        },
        error: function (result) {
            if(result.status == 401){
                displayErrorMessage('js.disconnect_or_reconnect');
            }else{
                manageAjaxErrors(result)
            }
        },
    })
}

listenClick('.editConsultationBtn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return
    }
    ajaxCallInProgress()
    let liveConsultationId = $(event.currentTarget).attr('data-id')
    renderConsultationData(liveConsultationId)
})

listenClick('.startConsultationBtn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return
    }
    ajaxCallInProgress()
    let liveConsultationId = $(event.currentTarget).attr('data-id')
    startRenderConsultationData(liveConsultationId)
})

function startRenderConsultationData (id) {
    $.ajax({
        url: $('#indexLiveConsultationUrl').val() + '/' + id + '/start',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let liveConsultation = result.data

                $('#startConsultationId').
                    val(liveConsultation.liveConsultation.id)
                $('.start-modal-title').text(
                    liveConsultation.liveConsultation.consultation_title)
                $('.host-name').
                    text(liveConsultation.liveConsultation.user.full_name)
                $('.date').text(
                    liveConsultation.liveConsultation.consultation_date)
                $('.minutes').text(
                    liveConsultation.liveConsultation.consultation_duration_minutes)
                $('#startModal').
                    find('.status').
                    append((liveConsultation.zoomLiveData.status ===
                        'started') ? $('.status').text('Started') : $(
                        '.status').text('Awaited'))
                $('.start').
                    attr('href', ($('#indexConsultationPatientRole').val())
                        ? liveConsultation.liveConsultation.meta.join_url
                        : ((liveConsultation.zoomLiveData.status ===
                            'started')
                            ? $('.start').addClass('disabled')
                            : liveConsultation.liveConsultation.meta.start_url),
                    )
                    if(liveConsultation.zoomLiveData.status === 'waiting'){
                        $('.start').removeClass('disabled')
                    }
                $('#startModal').modal('show')
                ajaxCallCompleted()
            }
        },
        error: function (result) {
            manageAjaxErrors(result)
        },
    })
}

listenClick('.deleteConsultationBtn', function (event) {
    let liveConsultationId = $(event.currentTarget).attr('data-id')
    deleteItem(
        $('#indexLiveConsultationUrl').val() + '/' + liveConsultationId,
        '',
        $('#liveConsultationLang').val(),
    )
})

listenChange('.change-consultation-status', function () {
    let statusId = $(this).val()
    $.ajax({
        url: $('#indexLiveConsultationUrl').val() + '/change-status',
        type: 'GET',
        data: { statusId: statusId, id: $(this).attr('data-id') },
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                Livewire.dispatch('refresh')
                // $('#liveConsultationTable').DataTable().ajax.reload(null, false);
            }
        },
        error: function (result) {
            manageAjaxErrors(result)
        },
    })
})

listenClick('.showConsultationData', function (event) {
    let consultationId = $(event.currentTarget).attr('data-id')
    $.ajax({
        url: $('#indexLiveConsultationUrl').val() + '/' + consultationId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let liveConsultation = result.data.liveConsultation

                let showModal = $('#show_live_consultations_modal')
                $('#startLiveConsultationId').val(liveConsultation.id)
                $('#showConsultationTitle').
                    text(liveConsultation.consultation_title)
                $('#showConsultationDate').
                    text(moment(liveConsultation.consultation_date).
                            format('Do MMM, Y') + ' ' +
                        moment(liveConsultation.consultation_date).
                            format('LT'))
                $('#showConsultationDurationMinutes').
                    text(liveConsultation.consultation_duration_minutes)
                $('#showConsultationPatient').
                    text(liveConsultation.patient.patient_user.full_name)
                $('#showConsultationDoctor').
                    text(liveConsultation.doctor.doctor_user.full_name);

                (liveConsultation.type == 0) ? showModal.find(
                    '#showConsultationType').append('OPD') : showModal.find(
                    '#showConsultationType').append('IPD');
                (liveConsultation.type == 0)
                    ? showModal.find('#showConsultationTypeNumber').
                        append(liveConsultation.opd_patient.opd_number)
                    : showModal.find('#showConsultationTypeNumber').
                        append(liveConsultation.ipd_patient.ipd_number);
                if (liveConsultation.platform_type != 2) {
                    $('.showConsultationHostVideo').removeClass('d-none')
                    $('.showConsultationParticipantVideo').removeClass('d-none');
                    $('#showConsultationHostVideo').text((liveConsultation.host_video === 0) ? 'Disable' : 'Enable');
                    $('#showConsultationParticipantVideo').text((liveConsultation.participant_video === 0) ? 'Disable' : 'Enable');
                    $('#showConsultationPlatformType').text(Lang.get('js.zoom'));
                } else {
                    $('.showConsultationHostVideo').addClass('d-none')
                    $('.showConsultationParticipantVideo').addClass('d-none');
                    $('#showConsultationPlatformType').text(Lang.get('js.google_meet'));
                }
                isEmpty(liveConsultation.description) ? $(
                    '#showConsultationDescription').text('N/A') : $(
                    '#showConsultationDescription').
                    text(liveConsultation.description)
                showModal.modal('show')
            }
        },
        error: function (result) {
            manageAjaxErrors(result)
        },
    })
})
listenHiddenBsModal('#show_live_consultations_modal', function () {
    $(this).
        find(
            '#showConsultationTitle, #showConsultationDate, #showConsultationDurationMinutes, #showConsultationPatient, #showConsultationDoctor, #showConsultationType, #showConsultationTypeNumber, #showConsultationHostVideo, #showConsultationParticipantVideo, #showConsultationDescription').
        empty()
})

listenClick('.add-credential', function () {
    if ($('.ajaxCallIsRunning').val()) {
        return
    }
    ajaxCallInProgress()
    let userId = $('#zoomUserId').val()
    renderUserZoomData(userId)
})

function renderUserZoomData (id) {
    $.ajax({
        url: 'user-zoom-credential/' + id + '/fetch',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let userZoomData = result.data
                if (!isEmpty(userZoomData)) {
                    $('#zoomApiKey').val(userZoomData.zoom_api_key)
                    $('#zoomApiSecret').val(userZoomData.zoom_api_secret)
                }
                $('#addCredential').modal('show')
                ajaxCallCompleted()
            }
        },
        error: function (result) {
            manageAjaxErrors(result)
        },
    })
}

listenSubmit('#addZoomForm', function (event) {
    event.preventDefault()
    let loadingButton = jQuery(this).find('#btnZoomSave')
    loadingButton.button('loading')
    $.ajax({
        url: $('#indexZoomCredentialCreateUrl').val(),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#addCredential').modal('hide')
                setTimeout(function () {
                    loadingButton.button('reset')
                }, 2500)
                Livewire.dispatch('refresh')
            }
        },
        error: function (result) {
            printErrorMessage('#credentialValidationErrorsBox', result)
            setTimeout(function () {
                loadingButton.button('reset')
            }, 2000)
        },
    })
})

listenChange('#liveConsultationFilterStatusArr', function () {
    Livewire.dispatch('changeFilter', {statusFilter: $(this).val()})
})
listenClick('#consultationResetFilter', function () {
    $('#liveConsultationFilterStatusArr').val(0).trigger('change')
    hideDropdownManually($('#liveConsultationFilterBtn'),
        $('.dropdown-menu'))
})

listenChange('.consultation-type', function () {
    $('.consultation-type-number').val('').trigger('change')
})

listenChange('.patient-name', function () {
    $('.consultation-type').val('').trigger('change')
    $('.consultation-type-number').trigger('change')
})

listenChange('.platform-type', function () {
    let googleMeet = $(this).val();

    if(googleMeet == 2 && googleMeet != undefined){
        $('.host-video-section').addClass('d-none');
        $('.participant-video-section').addClass('d-none');
    }else{
        $('.host-video-section').removeClass('d-none');
        $('.participant-video-section').removeClass('d-none');
    }
});
