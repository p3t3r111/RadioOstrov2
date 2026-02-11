@extends('layouts.main')

@section('title')
    {{ __('admin.dashboard') }}
@endsection

@section('content')
    <x-admin-section-header>{{ __('admin.dashboard') }}</x-admin-section-header>
    <section class="p-8">
        <div class="grid lg:grid-cols-3 gap-8 items-center">
            <x-admin-card title="{{ __('admin.confirming_songs') }}" link='admin.confirming-songs'
                info="{{ __('admin.confirming_songs_text', ['count' => $songsToConfirm]) }}"></x-admin-card>
            <x-admin-card title="{{ __('admin.authorized_songs') }}" link='admin.authorized-songs'
                info="{{ __('admin.authorized_songs_text', ['count' => $confirmedSongs]) }}"></x-admin-card>
            <x-admin-card title="{{ __('admin.denied_songs') }}" link='admin.denied-songs'
                info="{{ __('admin.denied_songs_text', ['count' => $deniedSongs]) }}"></x-admin-card>
            <x-admin-card title="{{ __('admin.backup_songs') }}" link='admin.backup-songs'
                info="{{ __('admin.backup_songs_text', ['count' => $backupSongs]) }}"></x-admin-card>
            <x-admin-card title="{{ __('admin.play_songs') }}" link='admin.playSongs' info=""></x-admin-card>
            <x-admin-card title="{{ __('admin.holidays') }}" link='admin.holidays' info=""></x-admin-card>
            <x-admin-card title="{{ __('admin.updates') }}" link='admin.updates' info=""></x-admin-card>
            <x-admin-card title="{{ __('admin.pause_songs.title') }}" link="admin.pauseSongs" info="{{ __('admin.pause_songs.info') }}" :disabled="!$playingSongs" :disabledInfo="__('admin.pause_songs.disabled_info')">{{ __('admin.pause_songs.action') }}</x-admin-card>
        </div>
    </section>
@endsection
