// var Vue = require('vue');
// var VueResource = require('vue-resource');

//vue 2.0写法
import Vue from 'vue/dist/vue.js';
import VueResource from 'vue-resource';

Vue.use(VueResource);

Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr('content');
//resource路由
// var resource = Vue.resource('/tasks/{{ $task->id }}/steps{/id}');
//var resource = Vue.resource(top.location+'/steps{/id}');
var resource = Vue.resource("/tasks/"+$("#taskId").data("id")+'/steps{/id}');
new Vue({
	el:"#app1",
	data:{
		// message:"hello"
		steps:[
			{name:"", completed:false},
		],
		newStep:"",
		// baseUrl:"/tasks/{{ $task->id }}/steps"
		baseUrl:"/tasks/"+$("#taskId").data("id")+"/steps"
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