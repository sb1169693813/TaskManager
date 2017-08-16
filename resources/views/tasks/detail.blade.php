@extends('layouts.app')

@section('content')
	<div id="app" class="container">
		<ul class="list-group">
			<li class="list-group-item" v-for="step in steps">@{{ step.name }}</li>
			<input type="text" class="form-control" v-model="newStep" @keyup.enter="addStep">
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
				}
			}
		});

	</script>
@endsection