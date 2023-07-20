@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @component('components.part.app_header')
            <h1>Change Password</h1>
        @endcomponent
        @component('components.alert.success')
        @endcomponent

        <div class="row">
            <div class="col-md-6">


                <form action="{{ route('web.profile.change.password.save') }}" method="POST" class="mb-3">
                    @csrf

                    @component('components.form.input', [
                        'field' => 'old_password',
                        'label' => 'Old Password',
                        ])
                    @endcomponent
                    @component('components.form.input', [
                        'field' => 'password',
                        'label' => 'New Password',
                        ])
                    @endcomponent
                    @component('components.form.input', [
                        'field' => 'password_confirmation',
                        'label' => 'Confirm New Password',
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
