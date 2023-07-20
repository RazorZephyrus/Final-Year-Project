@if (\Session::has($name ?? 'success_message'))
<div class="alert alert-primary">
    {!! \Session::get($name ?? 'success_message') !!}
</div>
@endif