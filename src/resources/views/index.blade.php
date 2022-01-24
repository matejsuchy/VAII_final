@extends('layouts.app')
@section('scripts_bottom')
<script src="{{ asset('js/hra.js') }}"></script>
@endsection

@section('content')
<h1>Vitajte v hre <span class="strong">Minútovka.</span> </h1>

<p>
    <span class="underline">Cieľom hry je v priebehu 1 minúty prepísať čo najviac slov presne v rovnakej
        podobe ako sa zobrazujú zvýrazneným tučným písmom.</span> Slová na prepisovanie sa nachádzajú v poli nižšie. Vpravo od neho sa nachádza časomiera, ktorá začne odpočítavať 60 sekúnd, akonáhle stlačíte prvé písmeno znaku
    na klávesnici.
</p>
<div class="row gx-3 justify-content-center">
    <div class="col-md game-choose m-2">
        <p>Dosiahni čo najvyššie skóre a dostaň sa do siene slávy!</p>

        <button class="btn btn-primary" type="button">Singleplayer</button>

    </div>
    <div class="col-md game-choose m-2">
        <p>Zahraj si hru proti viacerím hráčom!</p>
        <div>
            <button class="btn btn-primary btn-block" type="button">Multiplayer</button>
        </div>

    </div>
</div>

<div class="row container-fluid m-2 typingGame">
    <div class="row container-fluid m-2">
        <p class="timer col text-center">Zostáva: 60 s</p>
    </div>
    <div class="statsGrid flex-row d-flex justify-content-center">
        <div class="typoStat col-md">
            <p class="p-1 wpm">WPM</p>
            <p class="statValue">100</p>
        </div>
        <div class="typoStat col-md">
            <p class="p-1 cpm">CPM</p>
            <p class="statValue">100</p>
        </div>
        <div class="typoStat col-md">
            <p class="p-1 presnost">Presnosť</p>
            <p class="statValue">100%</p>
        </div>
        <div class="typoStat col-md">
            <p class="p-1 prepisaneSlova">Prepisane slová</p>
            <p class="statValue">0</p>
        </div>
        <div class="typoStat col-md">
            <p class="p-1 chyby">Chyby</p>
            <p class="statValue">0</p>
        </div>
    </div>
    <blockquote class="blockquote text-center prepis">
        <p class="rewriteText "></p>
        <footer class="blockquote-footer autor"></footer>
    </blockquote>
    <textarea class="textArea" name="textArea"></textarea>
</div>



@endsection