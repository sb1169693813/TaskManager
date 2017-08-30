@extends('layouts.app')

@section('customHeader')
	<meta name="token" id="token" content="{{ csrf_token() }}">
@endsection

@section('content')
	<div id="app" class="container">
		<h1 v-if="inProcessNum.length">
		未完成的步骤(@{{ inProcessNum.length }})
		<span class="btn btn-sm btn-info" @click="completeAll()"> 完成所有</span>
		</h1>
		<ul class="list-group">
			<li class="list-group-item" v-for="step in inProcess">
				<span @dblclick="editStep(step)">@{{ step.name }}</span>
				<span class="pull-right">
					<i class="fa fa-check" @click="toggelComplete(step)">对</i>
					<i class="fa fa-close" @click="removeStep(step)">x</i>
				</span>
			</li>
		</ul>

		<form @submit.prevent="addStep" class="form-inline">
			<label v-if="!newStep">完成该任务（task）需要哪些步骤（step）呢？</label>
			<input type="text" class="form-control" v-model="newStep" ref="input" placeholder="i need to ...">
			<button type="submit" class="btn btn-primary" v-if="newStep">添加步骤</button>
		</form>

		<h1 v-if="processedNum.length">
			已完成的步骤(@{{ processedNum.length}})
			<span class="btn btn-sm btn-danger" @click="clearAll()"> 清除所有已完成的</span>
		</h1>
		<ul class="list-group">
			<li class="list-group-item" v-for="step in processed">@{{ step.name }}
				<span class="pull-right">
					<i class="fa fa-check" @click="toggelComplete(step)">对</i>
					<i class="fa fa-close" @click="removeStep(step)">x</i>
				</span>			
			</li>
		</ul>
		@{{ $data }}
	</div>
@endsection

@section('customJS')
	<script src="{{ asset('js/vue.js') }}"></script>
	<script src="{{ asset('js/vue-resource.js') }}"></script>
	<script>
		Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr('content');
		// alert($("#token").attr('content'));
		var app = new Vue({
			el:"#app",
			data:{
				// steps:{
				// 	name:'fix bug',
				// 	completed:false
				// }
				steps:[
					{name:'',completed:false},
					// {name:'meeting',completed:false}
				],
				newStep:''
			},
			mounted:function(){
				this.fetchSteps();
			},
			methods:{
				fetchSteps:function(){
					this.$http.get('/tasks/16/steps').then((response)=>{
						//success
						this.steps = response.body;
					},(response)=>{
						//error
						response.status;
					});
				},
				addStep:function(){
					//alert('aaa');
					// this.steps.push({name:this.newStep,completed:false});
					this.$http.post('/tasks/16/steps',{name:this.newStep}).then((response)=>{
						//success
						this.newStep = '';
						this.fetchSteps();
					},(response)=>{
						//error
						response.status;
					});
					
				},
				// complete:function(step){
				// 	step.completed = true;
				// },
				toggelComplete:function(step){
					// step.completed = !step.completed;
					this.$http.put('/tasks/16/steps/'+step.id,{opposite:!step.completed}).then((response)=>{
						this.fetchSteps();
					},(response)=>{
						response.status;
					});
				},
				removeStep:function(step){
					// var index = this.steps.indexOf(step);
					// this.steps.splice(index,1);
					// alert("remove");
					this.$http.delete('/tasks/16/steps/'+step.id).then((response)=>{
						this.fetchSteps();
					},(response)=>{
						response.status;
					});
				},
				editStep:function(step){
					this.removeStep(step);//移除这一栏
					this.newStep = step.name;//input 变成这一栏
					//聚焦
					this.$refs.input.focus();
					// this.$http.put('/tasks/16/steps/'+step.id+'edit',{name:this.newStep}).then((response)=>{
					// 	this.fetchSteps();
					// },(response)=>{
					// 	response.status;
					// });
				},
				completeAll:function(){
					return this.steps.forEach(function(step){
						step.completed = true;
					});
				},
				clearAll:function(){
					this.steps = this.steps.filter(function(step){
						return step.completed == false;//返回已完成的
					});
				}
			},
			// computed:{
			// 	inProcess:function(){
			// 		//return ! steps.completed;
			// 		return this.steps.filter(function(step){
			// 			return !step.completed;
			// 		});
			// 	}
			// }
			computed:{
				inProcess:function(){
					return this.steps.filter(function(step){
						return step.completed == false;
					});
				},
				processed:function(steps){
					return this.steps.filter(function(step){
						return step.completed == true;
					});
				},
				inProcessNum:function(){
					return this.steps.filter(function(step){
						return step.completed == false;
					});
				},
				processedNum:function(){
					return this.steps.filter(function(step){
						return step.completed == true;
					});
				}
			}
		});

	</script>
@endsection