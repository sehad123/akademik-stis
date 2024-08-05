@if (!empty(session('success')))
    <div class="aler alert-success text-center  mb-3 " role="alert">
        {{ session('success') }}
    </div>
@endif

@if (!empty(session('error')))
    <div class="aler alert-danger text-center  mb-3 " role="alert">
        {{ session('error') }}
    </div>
@endif

@if (!empty(session('payment-error')))
    <div class="aler alert-error  " role="alert">
        {{ session('payment-error') }}
    </div>
@endif

@if (!empty(session('warning')))
    <div class="aler alert-warning  " role="alert">
        {{ session('warning') }}
    </div>
@endif

@if (!empty(session('info')))
    <div class="aler alert-info text-center mb-3 " role="alert">
        {{ session('info') }}
    </div>
@endif

@if (!empty(session('secondary')))
    <div class="aler alert-secondary  " role="alert">
        {{ session('secondary') }}
    </div>
@endif

@if (!empty(session('primary')))
    <div class="aler alert-primary  " role="alert">
        {{ session('primary') }}
    </div>
@endif

@if (!empty(session('light')))
    <div class="aler alert-light  " role="alert">
        {{ session('light') }}
    </div>
@endif




@if (session()->has('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

{{-- @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif --}}

@if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

