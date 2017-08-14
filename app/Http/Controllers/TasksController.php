<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;
use App\Task;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $project = Auth::user()->projects()->where('name',$name)->first();
        $toDo = Auth::user()->tasks()->where('completed',0)->paginate();
        $done = Auth::user()->tasks()->where('completed',1)->paginate();
        $projects = Project::pluck('name','id');
        return view('tasks.index',compact('toDo','done','projects'));
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
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTaskRequest $request)
    {
        //return $request->id;
        $project = Project::findOrFail($request->id);
        $data = $request->input();
        $data['project_id'] = $request->id;
        $data['title'] = $request->name;
        $project->tasks()->create($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        //return $request;
        $task = Task::findOrFail($id);
        $data = $request->input();
        // return $data;
        $data['project_id'] = $request->projectList;
        $task->fill($data)->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::findOrFail($id)->delete();
        return redirect()->back();
    }


    public function check($id)
    {
        // return $id;
        $project = Task::findOrFail($id);
        $project->completed = 1;
        $project->save();
        return redirect()->back();
    }
}
