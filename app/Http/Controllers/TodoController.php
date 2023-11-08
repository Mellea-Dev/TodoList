<?php

namespace App\Http\Controllers;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(){
        $todos = Todo::orderBy('id','desc')->get();
        return view('todo_list', compact('todos'));  
    }

  
    public function store(Request $request){
        $request->validate([
            'title' => 'required'
        ]);

        Todo::create($request->post());
        return redirect()->route('todos.index')->with('success','Todo has been created successfully.');
    }
 

    public function update(Request $request, int $id){

        $request->validate([
            'title' => 'required'
        ]);

        $todo = Todo::find($id);

        $todo->fill($request->post())->save();

        return redirect()->route('todos.index')->with('success','Todo Has Been updated successfully');
    }

    public function delete(int $id){
        $todo = Todo::find($id);

        $todo->delete();

        return redirect()->route('todos.index')->with('success','Todo Has Been deleted successfully');

    }
}
