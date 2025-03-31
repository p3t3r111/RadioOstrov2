@extends('layouts.auth')
@section('title')
Rádio Ostrov | Obnova Hesla
@endsection

@section('content') 
<div class="field flex flex-col justify-center items-center gap-2">
    <img src="{{ asset('assets/logo.png') }}"
            class="w-[100px] h-[100px] mb-5 animate-blink" alt="Logo školy : Stredná odborná škola informačných technológií, Ostrovského 1, Košice">
    <h1 class="subtitle mb-3 font-semibold text-xl text-[#4a4a4a]">RÁDIO OSTROV | OBNOVA HESLA</h1>
</div>
<div class="w-full bg-green-600">
    <strong>Úspech!</strong>
    <p>Zadajte nové heslo.</p>
</div>
<form action="forgot.php?mode=enter_password" method="post">
    <label for="email">Nové heslo</label>
    <div class="field">
        <p class="control has-icons-left">
            <input type="password" name="pass" id="pass" placeholder="Nové heslo" class="input" required>
            <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
            </span>
        </p>
    </div>
    <label for="email">Heslo znovu</label>
    <div class="field">
        <p class="control has-icons-left">
            <input type="password" name="pass2" id="pass2" placeholder="Heslo znovu" class="input" required>
            <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
            </span>
        </p>
    </div>
    <div class="field">
        <input class="button is-send" type="submit" value="Ďalej"></input>

    </div>
    <div class="field">
        <p class="register"><a href="login" class="register">Späť na prihlásenie</a></p>
    </div>
</form>
@endsection

@section('scripts')
<script src="{{ asset('js/auth/inputs.js') }}"></script>
@endsection