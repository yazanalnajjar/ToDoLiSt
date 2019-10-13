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


    public function ForOneTask($id){
        return Task::find($id);
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
        return $user->tasks('is_completed', false)
                    ->orderBy('created_at', 'asc')
                    ->withCount(['tasks' => function ($query) {
                        $query->where('is_completed', false);
                    }])
                    ->get();
    }



    public function update(Request $request , $id){
        $task=tasks::findOrFail($id);
        $task->update($request->all());
        return $task;
    }


    public function delete(Request $request, $id){ // delete one
        $task= Task::findOrFail($id);
        $task->delete();
        return 204;
    }




    public function markCompleted(Task $task)
    {
        $task->is_completed = true;
        $task->update();
        return response()->json('updated!');
    }



}
