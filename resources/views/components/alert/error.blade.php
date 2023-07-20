{{-- {{dd($errors)}} --}}
@if (count($errors) != 0)
    <p class="mb-4">
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{ $errors->first() }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
    </div>
    </p>
@endif