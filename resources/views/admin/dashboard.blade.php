@extends('layouts.main')

@section('title')
    Rádio ostrov | Admin dashboard
@endsection

@section('content')
    <x-admin-section-header>Admin dashboard</x-admin-section-header>
    <section class="p-8">
        <div class="grid lg:grid-cols-3 gap-8 items-center">
            <x-admin-card title="Pesničky na schválenie" link='admin.confirming-songs'
                info="Počet pesničiek na schválenie : {{ $songsToConfirm }}">Kliknite pre správu</x-admin-card>
            <x-admin-card title="Schválené pesničky" link='admin.authorized-songs'
                info="Počet potvrdených pesničiek : {{ $confirmedSongs }}">Kliknite pre správu</x-admin-card>
            <x-admin-card title="Zamietnuté pesničky" link='admin.denied-songs'
                info="Počet zamietnutých pesničiek : {{ $deniedSongs }}">Kliknite pre správu</x-admin-card>
            <x-admin-card title="Záložne pesničky" link='admin.backup-songs'
                info="Počet back up pesničiek : {{ $backupSongs }}">Kliknite pre správu</x-admin-card>
            <x-admin-card title="Pesničky na zapnutie" link='admin.playSongs' info="">Kliknite pre správu</x-admin-card>
        </div>
    </section>
@endsection