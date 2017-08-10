<!-- Modal -->
<div class="modal fade" id="editModal-{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-{{ $project->id }}">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editModalLabel-{{ $project->id }}">编辑项目</h4>
      </div>
       {!! Form::model($project,['route'=>['projects.update',$project->id],'method'=>'PUT','files'=>'true'])!!}
      <div class="modal-body">
          <div class="form-group">
            {!! Form::label('name','项目名称',['class'=>'control-label'])!!}
            {!! Form::text('name',$project->name,['class'=>'form-control','disabled'=>'true']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('thumbnail','项目缩略图',['class'=>'control-lable'])!!}
            {!! Form::file('thumbnail') !!}
          </div>

          @include('errors._error')
      </div>
      <div class="modal-footer">
        {!! Form::submit('编辑项目',['class'=>'btn btn-primary']) !!}
      </div>
      {!! Form::close()!!}
    </div>
  </div>
</div>