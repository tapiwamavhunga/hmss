'use strict'

Livewire.hook("element.init", () => {
    $("#doctorsHead").select2({
        width: "100%",
    });
});

listenClick('.doctor-delete-btn', function (event) {
    let doctorId = $(event.currentTarget).attr('data-id');
    deleteItem($('#indexDoctorUrl').val() + '/' + doctorId, '#doctorsTable',
        $('#doctorLang').val())
});

listenChange('.doctor-active-status', function (event) {
    let doctorId = $(event.currentTarget).attr('data-id');
    updateDoctorActiveStatus(doctorId);
});

function updateDoctorActiveStatus (id) {
    $.ajax({
        url: $('#indexDoctorUrl').val() + '/' + +id + '/active-deactive',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                Livewire.dispatch('refresh')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    });
};

listenClick('#doctorResetFilter', function () {
    $('#doctorsHead').val(2).trigger('change');
    hideDropdownManually($('#doctorsFilterBtn'), $('.dropdown-menu'));
});

listenChange('#doctorsHead', function () {
    Livewire.dispatch('changeFilter', {statusFilter: $(this).val()})
});


