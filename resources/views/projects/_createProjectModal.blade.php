<!-- Button trigger modal -->
<button type="button" class="btn btn-default modal-trigger" data-toggle="modal" data-target="#exampleModal">
  <i class="fa fa-btn fa-plus"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">新建项目</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::open(['route'=>'projects.store','method'=>'POST','files'=>'true'])!!}
      <div class="modal-body">
          <div class="form-group">
            {!! Form::label('name','项目名称',['class'=>'control-label'])!!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('thumbnail','项目缩略图',['class'=>'control-lable'])!!}
            {!! Form::file('thumbnail') !!}
          </div>

          @include('errors._error')
      </div>
      <div class="modal-footer">
        {!! Form::submit('新建项目',['class'=>'btn btn-primary']) !!}
      </div>
      {!! Form::close()!!}
    </div>
  </div>
</div>
