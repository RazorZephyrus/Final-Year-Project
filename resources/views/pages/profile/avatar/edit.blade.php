@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @component('components.part.app_header')
            <h1>Change Avatar</h1>
        @endcomponent
        @component('components.alert.success')
        @endcomponent

        <div class="row">
            <div class="col-md-6">
                @if (!empty(auth()->user()->avatar->url))
                    <div class="mb-4">
                        <img src="{{ auth()->user()->avatar->url }}" alt="" width="200"> 
                    </div>
                @endif


                <form action="{{ route('web.profile.change.avatar.save') }}" method="POST" class="mb-3"
                    enctype="multipart/form-data">
                    @csrf
                    @component('components.form.input', [
                        'field' => 'avatar',
                        'label' => 'Avatar',
                        'type' => 'file',
                        ])
                    @endcomponent

                    <button type="submit" class="btn app-btn btn-primary">
                        <div class="px-5">Save</div>
                    </button>
                </form>




            </div>
        </div>
    </div>
@endsection
