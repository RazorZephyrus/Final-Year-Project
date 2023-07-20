@if ($errors != '[]')
    @php
        $err = json_decode($errors, true);
    @endphp 
    <p class="mb-4">
    <div class="alert alert-danger alert-dismissible" role="alert">
        <ul>
            @foreach ($err as $key => $value)
                @foreach ($value as $e)
                <li>{{$e}}</li>
                @endforeach
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
    </div>
    </p>
@endif