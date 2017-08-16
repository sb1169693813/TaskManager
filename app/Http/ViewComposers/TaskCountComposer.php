<?php
namespace App\Http\ViewComposers;

use illuminate\View\view;
use App\repositories\TasksRepository;

class TaskCountComposer
{
	protected $task;

	public function __construct(TasksRepository $taskRepo)
	{	
		$this->task = $taskRepo;
	}

	public function compose(View $view)
	{
		$view->with([
			'total' => $this->task->total(),
			'toDoCount' => $this->task->toDoCount(),
			'doneCount' => $this->task->doneCount(),
		]);
	}
}