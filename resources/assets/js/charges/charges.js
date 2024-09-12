'use strict';

listen('click', '#chargesResetFilter', function () {
    $('#filterChargeType').val(0).trigger('change');
    hideDropdownManually($('#ChargeFilterBtn'), $('.dropdown-menu'));
});

listen('click', '.charge-delete-btn', function (event) {
    let chargeId = $(event.currentTarget).attr('data-id');
    deleteItem($('.chargesURl').val() + '/' + chargeId,
        '#chargesTbl',
        $('#chargeLang').val())
});

listenChange('#filterChargeType', function () {
    Livewire.dispatch('changeFilter', {statusFilter: $(this).val()})
});
