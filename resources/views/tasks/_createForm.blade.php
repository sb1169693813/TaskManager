{!! Form::open(['route'=>['tasks.store','id'=>$project->id],'class'=>'form-inline']) !!}
	{!! Form::text('title',null,['placeholder'=>'有什么要完成的任务吗？','class'=>'form-control']) !!}

	<button type="submit" class="btn btn-success">
		<i class="fa fa-plus"></i>
	</button>
{!! Form::close() !!}
