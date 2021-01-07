<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::all();
        return view('todos.index')->with('todos', $todos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'name' => 'required|min:2|max:20',
            'description' => 'required'
        ]);
        $data = request()->all();

        $todo = new Todo();
        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $todo->completed = false;
    
        $todo->save();
        session()->flash('success', 'Todo created successfully.');
        return redirect('/todos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($todoId)
    {
        return view('todos.show')->with('todo', Todo::find($todoId));
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($todoId)
    {
        return view('todos.edit')->with('todo', Todo::find($todoId));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $todoId)
    {
        $this->validate(request(), [
            'name' => 'required|min:6|max:12',
            'description' => 'required'
        ]);
        $data = request()->all();
        $todo = Todo::find($todoId);
        $todo->name = $data['name'];
        $todo->description = $data['description'];

        $todo->save();
        session()->flash('success', 'Todo update successfully.');
        return redirect('/todos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($todoId)
    {
        $todo = Todo::find($todoId);
        $todo -> delete();
        session()->flash('success', 'Todo delete successfully.');
        return redirect('/todos');
    }
    public function complete(Todo $todo)
    {
    $todo->completed = true;
    $todo->save();

    session()->flash('success', 'Todo completed successfully.');

    return redirect('/todos');
    }
}
