<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{




    protected $tasks;
    // the user must be "logged into" the application in order to create a task
    public function __construct()
    {
        $this->middleware('auth');


        $this->tasks = $tasks;
    }



    public function index(Request $request)
    {
        return view('tasks.index', [
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }



    public function store(Request $request)
    {
    $this->validate($request, [
        'name' => 'required|max:255',
    ]);

    $request->user()->tasks()->create([
        'name' => $request->name,
    ]);

    return redirect('/tasks');
    }



    public function forUser(User $user)
    {
        return $user->tasks()
                    ->orderBy('created_at', 'asc')
                    ->get();
    }



    public function update(Request $request , $id){
        $task=tasks::findOrFail($id);
        $task->update($request->all());
        return $task;
    }


    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);
        $task->delete();
        return redirect('/tasks');
    }



}
