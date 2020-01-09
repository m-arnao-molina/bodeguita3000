@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@elseif (session('danger'))
    <div class="alert alert-danger" role="alert">
        {{ session('danger') }}
    </div>
@endif