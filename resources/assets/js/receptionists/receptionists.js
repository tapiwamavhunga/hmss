Livewire.hook("element.init", () => {
    $("#receptionist_filter_status").select2({
        width: "100%",
    });
});

listenClick('.delete-receptionist-btn', function (event) {
    let receptionistId = $(event.currentTarget).attr('data-id')
    deleteItem($('#receptionistUrl').val() + '/' + receptionistId,
        '#receptionistsTbl',
        $('#receptionistLang').val())
})

listenChange('#receptionist_filter_status', function () {
    Livewire.dispatch('changeFilter', {statusFilter: $(this).val()})
})

listenChange('.receptionistStatus', function (event) {
    let receptionistId = $(event.currentTarget).attr('data-id')
    updateReceptionistStatus(receptionistId)
})

listenClick('#receptionistResetFilter', function () {
    $('#receptionist_filter_status').val(2).trigger('change')
    hideDropdownManually($('#receptionistFilter'), $('.dropdown-menu'))
})

window.updateReceptionistStatus = function (id) {
    $.ajax({
        url: $('#receptionistUrl').val() + '/' + +id + '/active-deactive',
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

