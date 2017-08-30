@extends("layouts.app")

@section('content')
	<div id="app1" class="container">
		<h1>待完成的步骤</h1>
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
			<input type="text" v-model="newStep" ref="newStep" class="form-control">
			<button type="submit" class="btn btn-primary">添加数据</button>
		</form>

		<h1>已完成的步骤</h1>
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
	<script>
		new Vue({
			el:"#app1",
			data:{
				// message:"hello"
				steps:[
					{name:"fix bug", completed:false},
					{name:"dasao", completed:false}
				],
				newStep:""
			},
			methods:{
				addStep:function(){
					//alert(111);
					this.steps.push({name:this.newStep, completed:false});
					this.newStep="";
				},
				completed:function(step){
					step.completed = !step.completed;
				},
				removeStep:function(step){
					var index = this.steps.indexOf(step);
					// alert(index);
					this.steps.splice(index,1);
				},
				editStep:function(step){
					// alert(step.name);
					//移除这一栏
					this.removeStep(step);
					//输入框写入
					this.newStep = step.name;
					//聚焦
					this.$refs.newStep.focus();
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