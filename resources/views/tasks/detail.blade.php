@extends("layouts.app")
@section('customHeader')
	<meta name="token" id="token" content="{{ csrf_token() }}">
@endsection

@section('content')
	<div id="app1" class="container">
		<input type="hidden" id="taskId" data-id="{{ $task->id}}">
		<h1 class="text-muted">{{ $task->title}}</h1>
		<h1 v-if="falseStep.length">待完成的步骤(@{{ falseStep.length }})
		<span class="btn btn-sm btn-info" @click="completeAll">完成所有</span>
		</h1>
		<ul class="list-group">
			<li class="list-group-item" v-for="step in falseStep">
			<span @dblclick="editStep(step)">@{{ step.name }}</span>
				<span class="pull-right">
					<i class="fa fa-check" @click="completed(step)"></i>
					<i class="fa fa-close" @click="removeStep(step)"></i>
				</span>
			</li>
		</ul>

		<form @submit.prevent="addStep" class="form-inline">
			<!-- <input type="text" v-model="newStep" class="form-control" @keyup.enter="addStep"> -->
			<label v-if="!newStep">完成该任务（task）需要哪些步骤（step）呢？</label>
			<input type="text"  v-model="newStep" ref="newStep" class="form-control" placeholder="i need to ...">
			<button type="submit" v-if="newStep" class="btn btn-primary">添加数据</button>
		</form>

		<h1 v-if="trueStep.length">已完成的步骤(@{{ trueStep.length }})
			<span class="btn btn-sm btn-danger" @click="clearCompleted">清除所有已完成的</span>
		</h1>
		<ul class="list-group">
			<li class="list-group-item" v-for="step in trueStep">@{{ step.name }}
				<span class="pull-right">
					<i class="fa fa-check" @click="completed(step)"></i>
					<i class="fa fa-close" @click="removeStep(step)"></i>
				</span>			
			</li>
		</ul>
		@{{ $data }}
	</div>
@endsection

@section("customJS")
	<script src="{{ asset('js/app.js') }}"></script>
	<!-- <script src="{{ asset('js/vue.js') }}"></script>
	<script src="{{ asset('js/vue-resource.js') }}"></script>
	<script>
		
	</script>
@endsection