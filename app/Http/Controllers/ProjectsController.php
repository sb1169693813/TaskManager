<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;
use Auth;
use App\repositories\ProjectsRepository;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectsController extends Controller
{
    protected $Repo;

    public function __construct(ProjectsRepository $repo)
    {
        $this->Repo = $repo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(CreateProjectRequest $request)
    {
        $this->Repo->newProject($request);
        
        return redirect()->back();
    }

  
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        $project = Auth::user()->projects()->where('name',$name)->first();
        $toDo = $project->tasks()->where('completed',0)->get();
        $done = $project->tasks()->where('completed',1)->get();
        $projects = Project::pluck('name','id');
        return view('projects.show',compact('project','toDo','done','projects'));
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
    public function update(UpdateProjectRequest $request, $id)
    {
        //return $request->all();
        $this->Repo->updateProject($request,$id);
        
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
        Project::find($id)->delete();
        return redirect()->back();
    }
}
