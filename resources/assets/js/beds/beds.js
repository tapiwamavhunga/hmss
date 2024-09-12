'use strict';

listenClick('.bed-delete-btn', function (event) {
    let bedId = $(event.currentTarget).data('id');
    deleteItem($('.bedUrl').val() + '/' + bedId, '#bedsTbl',
        $('#bedLang').val())
});

// status activation deactivation change event
listenChange('.bed-status', function (event) {
    let bedId = $(event.currentTarget).data('id');
    activeDeActiveBedStatus(bedId);
});

listenChange('#bed_filter_status', function () {
    Livewire.dispatch('changeFilter', {statusFilter: $(this).val()})
});

listenClick('#bedResetFilter', function () {
    $('#bed_filter_status').val(0).trigger('change');
    hideDropdownManually($('#bedAssignFilterBtn'), $('.dropdown-menu'));
});

// activate de-activate Status
function activeDeActiveBedStatus(id) {
    $.ajax({
        url: $('.bedUrl').val() + '/' + id + '/active-deactive',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                // tbl.ajax.reload(null, false);
                Livewire.dispatch('refresh');

            }
        },
    });
};
