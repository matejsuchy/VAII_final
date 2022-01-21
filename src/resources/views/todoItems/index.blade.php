@extends('layouts.app')

@section('content')
<div class="container col-md-6 mt-3">
    <div class="card shadow-sm">
        <div class="card-body">
            <h1>To-do List</h1>
            @if (isset($task))
            <form action="{{ route('tasks.update', ['id' => $task->id]) }}" method="POST" autocomplete="off">
                @csrf
                @method('PATCH')
                <div class="input-group">
                    <input required type="text" name="content" class="form-control" placeholder="Add your task" value="{{ $task->content ?? ''}}">
                    <button type="submit" class="btn btn-dark btn-sm px-4"><i class="bi bi-check2"></i></button>
                </div>
            </form>
            @else
            <form action="{{ route('tasks.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="input-group">
                    <input required type="text" name="content" class="form-control" placeholder="Add your task" value="{{ $task->content ?? ''}}">
                    <button type="submit" class="btn btn-dark btn-sm px-4"><i class="bi bi-plus-square"></i></button>
                </div>
            </form>
            @endif
            @if (count($todolist))
                <ul class="list-group list-group mt-3">
                @foreach($todolist as $task)
                    <li class="list-group-item">
                        <p>{{ $task->content }} </p>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <div>
                                <button type="submit" class="btn btn-link btn-lg float-end"><i class="bi bi-trash-fill"></i></button>
                            </div>
                        </form>
                        <form action="{{ route('tasks.edit', $task->id) }}" method="GET">
                            @csrf
                            @method('edit')
                            <div>
                                <button type="submit" class="btn btn-link btn-lg float-end"><i class="bi bi-pencil-square"></i></button>
                            </div>
                        </form>
                    </li>
                @endforeach
                </ul>
            @else 
                <p class="text-center mt-3">Nemate ziadne ulohy.</p>
            @endif
        </div>
    </div>
</div>
{{-- 
<div class="container">
    <div class="row mt-5">
    <div class="col-lg-6">
    <form action="{{route('tasks.store')}}" method="post">
    <h4>Todo Form</h4>
    @csrf
    <div class="form-group">
    <input name="id" type="hidden" class="form-control" value="{{ $todo->id }}">
    <input placeholder="Text" name="text" type="text" class="form-control" value="{{ $todo->text }}" >
    </div>
    <button class="btn btn-success float-right">Save</button>
    </form>
    </div>
    <div class="col-lg-6">
    <h4>Todo List</h4>
    <table class="table">
        <tr>
            <th>Id</th>
            <th>Text</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach($todos as $todo)
        <tr>
            <td>{{$todo->id}}</td>
            <td>{{$todo->text}}</td>
            <td>
            <form action="{{route('tasks.destroy',[$todo->id])}}" method="post">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
            </td>
            <td>
            <a class="btn btn-sm btn-primary" href="{{route('tasks.showid',[$todo->id])}}" >Edit</a>
            </td>
        </tr>
        @endforeach
    </table>
    </div>
    </div>
    </div> --}}

@endsection