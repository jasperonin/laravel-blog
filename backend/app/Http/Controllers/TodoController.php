<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;


class TodoController extends Controller
{   Private $todo;
    // to instantiate an object Todo
    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }
    
    public function index(){
        $all_tasks = $this->todo->latest()->get();
        return view('todo.index')->with('all_tasks',$all_tasks);
    }

    //create / insert task
    public function store(Request $request){
        // $request -> validate([

        //     'taks'=> 'required | min:1 | max:50 '
        // ]);

        $this->todo->task = $request->task;
        $this->todo->save();

        return redirect()->back();
    }

    public function edit($id){
        $task = $this->todo->findOrFail($id);

        return view('todo.edit')->with('task',$task);
    }

    public function update(Request $request, $id){

        // $request->validate([
        //     'task' => 'required| min:1 | max:50'
        // ]);

        $task = $this->todo->findOrFail($id);
        $task->task = $request->task;
        $task->save();

        return redirect()->route('todo.index');
    }

    public function destroy($id){

        $this-> todo->destroy($id);

        return redirect()->back();
    }
}
