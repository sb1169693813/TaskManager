@extends('layouts.app')

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
					<i class="fa fa-check" @click="toggelComplete(step)"></i>
					<i class="fa fa-close" @click="removeStep(step)"></i>
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
					<i class="fa fa-check" @click="toggelComplete(step)"></i>
					<i class="fa fa-close" @click="removeStep(step)"></i>
				</span>			
			</li>
		</ul>
		@{{ $data }}
	</div>
@endsection

@section('customJS')
	<script src="{{ asset('js/vue.js') }}"></script>
	<script>
		var app = new Vue({
			el:"#app",
			data:{
				// steps:{
				// 	name:'fix bug',
				// 	completed:false
				// }
				steps:[
					{name:'fix bug',completed:false},
					{name:'meeting',completed:false}
				],
				newStep:''
			},
			methods:{
				addStep:function(){
					//alert('aaa');
					this.steps.push({name:this.newStep,completed:false});
					this.newStep = '';
				},
				// complete:function(step){
				// 	step.completed = true;
				// },
				toggelComplete:function(step){
					step.completed = !step.completed;
				},
				removeStep:function(step){
					var index = this.steps.indexOf(step);
					this.steps.splice(index,1);
				},
				editStep:function(step){
					this.removeStep(step);//移除这一栏
					this.newStep = step.name;//input 变成这一栏
					//聚焦
					this.$refs.input.focus();
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
				inProcess:function(steps){
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