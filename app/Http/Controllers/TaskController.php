<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $tasks = Task::orderBy('position','ASC')->get();

        return view('task',compact('tasks'));
    }

    public function createTask()
    {
        $projects = Project::orderBy('created_at','DESC')->get();

        return view('create-task',compact('projects'));
    }

    public function editTask($id)
    {
        $task = Task::where('id', $id)->get();

        return view('edit-task', compact('task'));

    }

    public function update(Request $request)
    {
        $posts = Task::all();

        foreach ($posts as $post) {
            foreach ($request->order as $order) {
                if ($order['id'] == $post->id) {
                    $post->update(['position' => $order['position']]);
                }
            }
        }

        return response('Update Successfully.', 200);
    }

    public function addTask(Request $request)
    {
        try {

            $this->validate($request, [
                'name' => 'required|string|between:2,100',
                'description' => 'required|string',
                'project' => 'required|integer',
                'priority' => 'string',
            ]);

            $checkDuplicate = Task::where('name', $request->name)->first();

            if ($checkDuplicate) {
                return redirect()
                    ->route('tasks')
                    ->with('error', 'Task already exist.');
            } else {

                $data = array(
                    'name' => $request['name'],
                    'description' => $request['description'],
                    'priority' => $request['priority'],
                    'project_id' => $request['project'],
                );

                Task::create($data);

                return redirect()->route('tasks')
                    ->with('success', 'Task created successfully.');
            }
        }
        catch (\Exception $ex) {
            return $ex->getMessage();
        }

    }

    public function updateTask(Request $request, $id)
    {
        try {
            if($id !== null) {

                $this->validate($request, [
                    'name' => 'required|string|between:2,100',
                    'description' => 'required|string',
                    'priority' => 'string',
                ]);

                $data = array(
                    'name' => $request['name'],
                    'description' => $request['description'],
                    'priority' => $request['priority'],
                );

                Task::where('id', $id)->update($data);

                return redirect()->route('tasks')
                    ->with('success', 'Task updated successfully.');
            }
            return redirect()->route('tasks');
        }
        catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function removeTask($id)
    {
        Task::where('id', $id)->delete($id);
        return response()->json(['success'=>"Task Deleted successfully.", 'tr'=>'tr_'.$id]);
    }
}
