<?php

namespace App\Http\Controllers;

use App\Models\TodoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todolist = TodoItem::where('user_id', Auth::user()->id)->get(); 
        return view('/todoItems.index', compact('todolist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => 'required',
            'user_id' => ''
        ]);
        $data['user_id'] = Auth::user()->id;
        TodoItem::create($data);
        //dd($data);
        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TodoItem  $todoItem
     * @return \Illuminate\Http\Response
     */
    public function show(TodoItem $todoItem)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TodoItem  $todoItem
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todolist = TodoItem::where('user_id', Auth::user()->id)->get(); 
        return view('todoItems.index', ['task' => TodoItem::find($id), 'todolist' => $todolist]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TodoItem  $todoItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TodoItem $todoItem)
    {
        $data = $request->validate([
            'content' => 'required',
        ]);
        $updatedTodoItem = TodoItem::find($request->id);
        $updatedTodoItem->content = $request->content;
        $updatedTodoItem->save();
        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TodoItem  $todoItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TodoItem::findOrFail($id)->delete();
        return redirect('/tasks');
    }
}
