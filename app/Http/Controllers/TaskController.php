<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::get();
        return view('task.index',['tasks'=>$tasks]);
    }

    public function add(TaskRequest $request){
        $task = new Task;
        $task->name = $request->name;
        $task->save();

        return back();
    }

    public function destroy(Request $request){
        $task = Task::find($request->id);
        if(blank($task)){
            return redirect()->back()->with('fail','Deletion failed');
        }
        $delete = $task->delete();
        if($delete){
            return redirect()->back()->with('success','Deleted successfully');
        }else{
            return redirect()->back()->with('fail','Deletion failed');
        }
    }
}
