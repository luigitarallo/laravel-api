@if (session('message'))
<div class="container mb-5">
    <div class="alert alert-{{session('message_type') ?? 'info'}}" >
    {{session('message')}}
    </div>
</div>
@endif