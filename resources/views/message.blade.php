@if (!empty(session('error')))
    <div class="alert alert-danger alert-dismissable fade-in" role="alert">
        {{ session('error') }}
    </div>
@endif
@if (!empty(session('success')))
    <div class="alert alert-success alert-dismissable fade-in" role="alert">
        {{ session('success') }}
    </div>
@endif
@if (!empty(session('info')))
    <div class="alert alert-info alert-dismissable fade-in" role="alert">
        {{ session('info') }}
    </div>
@endif
