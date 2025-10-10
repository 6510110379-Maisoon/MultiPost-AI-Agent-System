@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Profile</h2>

    <div class="space-y-6">
        <div class="p-4 bg-white shadow rounded-lg">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="p-4 bg-white shadow rounded-lg">
            @include('profile.partials.update-password-form')
        </div>

        <div class="p-4 bg-white shadow rounded-lg">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
@endsection
