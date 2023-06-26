@if (session('message'))
<div id="flash-message" class="alert alert-success position-fixed top-0 px-5 py-2 border-top-0">
    {{ session('message') }}
</div>
@endif