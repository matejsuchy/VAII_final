@extends('layouts.app')

@section('content')
<main class="container main-content">
    <h1>Top 100 hráčov</h1>
    <div class="row">
        <div class="top col-md">
            Najrychlejsie pisal <span class="hrac"><a href="#">Fero</a></span> s poctom xyz slov za minutu
        </div>
        <div class="top col-md">
            Najneomylnejší hráč .....
        </div>
        <div class="top col-md">
            Najviac hier odohral ....
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Obodbie
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="#">Dnes</a></li>
                <li><a class="dropdown-item" href="#">Tento týždeň</a></li>
                <li><a class="dropdown-item" href="#">Celkovo</a></li>
            </ul>
        </div>
    </div>
    <table class="table table-striped table-hover ">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Meno</th>
                <th scope="col">Priezvisko</th>
                <th scope="col">WPM (words per minute)</th>
                <th scope="col">Presnosť</th>
            </tr>
        </thead>
        @foreach($records as $record)
        <tr>
            <td>{{ $record['id'] }}</td>
            <td>{{ $record->user->username }}</td>
            <td>{{ $record->user->email }}</td>
            <td>{{ $record['wpm'] }}</td>
            <td>{{ $record['accuracy'] }}%</td>
        </tr>
        @endforeach
    </table>
</main>
@endsection
