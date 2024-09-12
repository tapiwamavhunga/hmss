Livewire.hook("element.init", () => {
    $("#nurse_filter_status").select2({
        width: "100%",
    });
});

listenClick('.deleteNurseBtn', function (event) {
    let nurseId = $(event.currentTarget).data('id')
    deleteItem($('#nurseURL').val() + '/' + nurseId, '#nursesTbl', $('#nurseLang').val()
    )
})

listenChange('#nurse_filter_status', function () {
    Livewire.dispatch('changeFilter', {statusFilter: $(this).val()})
    // $(tableName).DataTable().ajax.reload(null, true)
})

listenChange('.nurseStatus', function (event) {
    let nurseId = $(event.currentTarget).data('id')
    updateNurseStatus(nurseId)
})

listenClick('#nurseResetFilter', function () {
    $('#nurse_filter_status').val(0).trigger('change')
    hideDropdownManually($('#nursesFilter'), $('.dropdown-menu'))
})

window.updateNurseStatus = function (id) {
    $.ajax({
        url: $('#nurseURL').val() + '/' + +id + '/active-deactive',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                // tbl.ajax.reload(null, false)
                Livewire.dispatch('refresh')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
}

