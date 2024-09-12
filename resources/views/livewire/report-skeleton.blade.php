<div class="listing-skeleton">
    <div class="card">
        <div class="card-content">
            <div class="d-flex justify-content-between">
                <div class="search-box pulsate rounded-1"> </div>
                <div class="d-flex">
                    @if (Request::is('investigation-reports','live-consultation'))
                        @include('livewire.filter-skeleton')
                    @endif
                </div>
            </div>
        </div>
        <div class="card-content my-5">
            <div class="table pulsate rounded-1"> </div>
            <div class="row">
                @for ($i = 1; $i <= 28; $i++)
                    <div class="col-3 mb-5">
                        <div class="column-box pulsate rounded-1"> </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>
