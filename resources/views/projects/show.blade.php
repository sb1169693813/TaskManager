@extends('layouts.app')

@section('content')
	<div class="container">
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
		    		<td>{{ $task->title }}</td>
		    		<td>@include('tasks._checkFrom')</td>
		    		<td>@include('tasks._editForm')</td>
		    	</tr>
		    @endforeach
	    	</table>
	    </div>
	    <!-- 已完成任务 -->
	    <div role="tabpanel" class="tab-pane" id="done">
		    <table class="table table-striped"> 
			    @foreach($done as $task)
			    	<tr><td>{{ $task->title }}</td></tr>
			    @endforeach
	    	</table>
	    </div>
	  </div>

	  @include('tasks._createForm')
	</div>
@endsection