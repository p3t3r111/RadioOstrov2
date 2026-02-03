@extends('layouts.main')



@section('title')
Rádio ostrov | {{ auth()->user()->name }}
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-[90%] mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-300 shadow sm:rounded-lg">
            <div class="">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div id="invite-link" class="p-4 sm:p-8 bg-white dark:bg-gray-300 shadow sm:rounded-lg">
            <div class="">
                @include('profile.partials.invite-link')
            </div>
        </div>

        <div id="personal-favorite-songs" class="p-4 sm:p-8 bg-white dark:bg-gray-300 shadow sm:rounded-lg">
            <div class="">
                @include('profile.partials.add-favorite-songs')
            </div>
        </div>

        {{-- <div class="p-4 sm:p-8 bg-white dark:bg-gray-300 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div> --}}

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-300 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection

