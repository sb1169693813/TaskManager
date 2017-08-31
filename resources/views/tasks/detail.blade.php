@extends("layouts.app")
@section('customHeader')
	<meta name="token" id="token" content="{{ csrf_token() }}">
@endsection

@section('content')
	<div id="app1" class="container">
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
	<script src="{{ asset('js/vue.js') }}"></script>
	<script src="{{ asset('js/vue-resource.js') }}"></script>
	<script>
		Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr('content');
		//resource路由
		var resource = Vue.resource('/tasks/{{ $task->id }}/steps{/id}');
		new Vue({
			el:"#app1",
			data:{
				// message:"hello"
				steps:[
					{name:"", completed:false},
				],
				newStep:"",
				baseUrl:"/tasks/{{ $task->id }}/steps"
			},
			mounted:function(){
				this.fetchStep();
			},
			methods:{
				fetchStep:function(){
					// this.$http.get('/tasks/16/steps').then((response)=>{
					resource.get().then((response)=>{
						//success
						this.steps = response.body;
						// console.log(response);
					},(response)=>{
						//error
						response.status;
					});
				},
				addStep:function(){
					//alert(111);
					// this.steps.push({name:this.newStep, completed:false});
					// this.newStep="";
					// this.$http.post('/tasks/16/steps', {name:this.newStep}).then((response)=>{
					resource.save('', {name:this.newStep}).then((response)=>{
						//success
						//this.steps = response.body;
						// console.log(response);
						this.newStep = "";
						this.fetchStep();
					},(response)=>{
						//error
						response.status;
					});
				},
				completed:function(step){
					// step.completed = !step.completed;
					// this.$http.put('/tasks/16/steps/'+step.id,{opposite:!step.completed}).then((response)=>{
					resource.update({id:step.id},{opposite:!step.completed}).then((response)=>{
						//success
						this.fetchStep();
					},(response)=>{
						//error
						response.status;
					});
				},
				removeStep:function(step){
					// var index = this.steps.indexOf(step);
					// // alert(index);
					// this.steps.splice(index,1);
					//tasks/{tasks}/steps/{steps}
					// this.$http.delete('/tasks/16/steps/'+step.id).then((response)=>{
					resource.remove({id:step.id}).then((response)=>{
						//success
						// this.newStep = "";
						this.fetchStep();
					},(response)=>{
						//error
						response.status;
					});
				},
				editStep:function(step){
					// alert(step.name);
					//移除这一栏
					this.removeStep(step);
					//输入框写入
					this.newStep = step.name;
					//聚焦
					this.$refs.newStep.focus();

				},
				completeAll:function(){
					// this.steps.forEach(function(step){
					// 	step.completed = true;
					// });
					// this.$http.post('/tasks/16/steps/completeall').then((response)=>{
					this.$http.post(this.baseUrl+'/completeall').then((response)=>{
						//success
						this.fetchStep();
					},(response)=>{
						//error
						response.status;
					});
				},
				clearCompleted:function(){
					//让steps等于未完成的
					// this.steps = this.steps.filter(function(step){
					// 	return !step.completed;
					// });
					// this.$http.post('/tasks/16/steps/clearall').then((response)=>{
					this.$http.post(this.baseUrl+'/clearall').then((response)=>{
						//success
						this.fetchStep();
					},(response)=>{
						//error
						response.status;
					});
				}
			},
			//计算属性
			computed:{
				falseStep:function(){
					return this.steps.filter(function(step){
						return !step.completed;
					});
				},
				trueStep:function(){
					return this.steps.filter(function(step){
						return step.completed;
					});
				}
			}
		})
	</script>
@endsection