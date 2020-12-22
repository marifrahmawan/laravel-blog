<div class="col-12">
    @if (session()->has('create-category'))
        <div class="alert alert-success alert-dismissible mt-2" role="alert">
            {{ session()->get('create-category') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('update-category'))
        <div class="alert alert-success alert-dismissible mt-2" role="alert">
            {{ session()->get('update-category') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('delete-category'))
        <div class="alert alert-success alert-dismissible mt-2" role="alert">
            {{ session()->get('delete-category') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('create-tag'))
        <div class="alert alert-success alert-dismissible mt-2" role="alert">
            {{ session()->get('create-tag') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('update-tag'))
        <div class="alert alert-success alert-dismissible mt-2" role="alert">
            {{ session()->get('update-tag') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('delete-tag'))
        <div class="alert alert-success alert-dismissible mt-2" role="alert">
            {{ session()->get('delete-tag') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>