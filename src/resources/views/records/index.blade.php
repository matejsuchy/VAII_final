@extends('layouts.app')

@section('content')
<div class="container main-content">
    <h1>Top 100 hráčov</h1>
    <div class="row">
        <div class="top col-md">
            Najrychlejsie pisal <span class="hrac"><a href="#">{{ $records->sortByDesc('wpm')->first()->user->username ?? 'Fero'}}</a></span> s poctom {{ $records->max('wpm') ?? '999'}} slov za minutu
        </div>
        <div class="top col-md">
            Najneomylnejší hráč {{ $records->sortByDesc('accuracy')->first()->user->username ?? 'Jozo'}} s {{ $records->sortByDesc('accuracy')->first()->accuracy ?? '90' }}% presnosťou. 
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
                <th scope="col">Nickname</th>
                <th scope="col">WPM (words per minute)</th>
                <th scope="col">Presnosť</th>
                <th scope="col">Dátum pridania</th>
                <th scope="col">Akcia</th>
            </tr>
        </thead>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->user->username }}</td>
            <td>{{ $record['wpm'] }}</td>
            <td>{{ $record['accuracy'] }}%</td>
            <td>{{ $record->created_at }}</td>
            <td>
                @if (Auth::user()->id == $record->user_id)
                <form action="{{ route('records.destroy', $record->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <div>
                        <button type="submit" class="btn btn-link btn-lg float-end"><i class="bi bi-trash-fill"></i></button>
                    </div>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
