<?php
namespace App\repositories;
use Image;
use App\Project;

class ProjectsRepository
{
	/**
	* 新建project
	*/
	public function newProject($request)
	{
		$data = $request->input();
        $data['thumbnail'] = $this->thumbnail($request);
        $request->user()->projects()->create($data);
	}
	
	  /**
     * 文件上传
     *
     * @param  \Illuminate\Http\Request  $request
     * @return name
     */
    public function thumbnail($request)
    {
        if($request->hasFile('thumbnail')){
            $file = $request->thumbnail;
            $name = str_random(10).'.jpg';
            $path = public_path().'/thumbnails/'.$name;
            Image::make($file)->resize(261,68)->save($path);
            return $name;
        }
    }

	/**
	* 编辑project
	*/
    public function updateProject($request,$id)
    {
    	//$data = $request->input();
    	 // $data = [];
    	$project = Project::findOrFail($id);
    	if($request->hasFile('thumbnail')){
    		$project->thumbnail = $this->thumbnail($request);
    	}
        
        if($request->name != $project->name){
        	$project->name = $request->name;
        }else{
        	$project->name = $project->name;
        }
        // return $data;
        $project->save();
    }	
}