@extends('layouts.app')

@section('content')
	<div class="container tasks-tabs">
	<!-- Nav tabs -->
	  <ul class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="active"><a href="#toDo" aria-controls="home" role="tab" data-toggle="tab">待完成</a></li>
	    <li role="presentation"><a href="#done" aria-controls="profile" role="tab" data-toggle="tab">已完成</a></li>
	  </ul>

	  <!-- Tab panes -->
	  <div class="tab-content">
	  <!-- 待完成任务 -->
	    <div role="tabpanel" class="tab-pane active" id="toDo">
		    <table class="table table-striped"> 
			    @foreach($toDo as $task)
			    	<tr>
			    		<td class="first-cell">{{ $task->title }}</td>
			    		<td class="icon-cell">@include('tasks._checkFrom')</td>
			    		<td class="icon-cell">@include('tasks._editForm')</td>
			    		<td class="icon-cell">@include('tasks._deleteForm')</td>
			    	</tr>
			    @endforeach
			    {{ $toDo->links() }}
	    	</table>
	    </div>
	    <!-- 已完成任务 -->
	    <div role="tabpanel" class="tab-pane" id="done">
		    <table class="table table-striped"> 
			    @foreach($done as $task)
			    	<tr><td>{{ $task->title }}</td></tr>
			    @endforeach
			    {{ $done->links() }}
	    	</table>
	    </div>
	  </div>
	</div>
@endsection