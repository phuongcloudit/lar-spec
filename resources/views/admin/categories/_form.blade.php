<div class="card-body">
    <div class="form-group">
        {{ Form::label('name', "カテゴリー名") }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
        @if ($errors->has('name'))
        <div class="alert alert-danger">
            <p>{{$errors->first('name')}}</p>
        </div>
        @endif
    </div>
    <div class="form-group">
        {{ Form::label('slug', "スラッグ") }}
        {{ Form::text('slug', null, ['class' => 'form-control']) }}
        @if ($errors->has('slug'))
        <div class="alert alert-danger">
            <p>{{$errors->first('slug')}}</p>
        </div>
        @endif
    </div>
    <div class="form-group">
        {{ Form::label('description', "ディスクリプション") }}
        {{ Form::textarea('description', null, ['class' => 'form-control', 'rows'=> 4]) }}
    </div>

</div>
<div class="card-footer">
    {{ Form::button('<i class="fas fa-save"></i> Save', ['class' => 'btn btn-primary','type'=>'submit']) }}
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary"> キャンセル</a>
</div>