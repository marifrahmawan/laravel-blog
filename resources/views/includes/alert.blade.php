@if (session()->has('success'))
    <div class="alert alert-success mt-2">
        {{ session()->get('success') }}
    </div>
@endif

@if (session()->has('error'))
    <div class="aler alert-danger mt-2">
        {{ session()->get('error') }}
    </div>
@endif

@if (session()->has('update'))
    <div class="alert alert-success mt-2">
        {{ session()->get('update') }}
    </div>
@endif

@if (session()->has('deleted'))
    <div class="alert alert-danger mt-2">
        {{ session()->get('deleted') }}
    </div>
@endif