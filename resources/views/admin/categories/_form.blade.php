<div class="card-body">
    <div class="form-group">
        {{ Form::label('name', "カテゴリー名") }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
        @if ($errors->has('name'))
        <div class="errors">
            <p>{{$errors->first('name')}}</p>
        </div>
        @endif
    </div>
    <div class="form-group">
        {{ Form::label('slug', "スラッグ") }}
        {{ Form::text('slug', null, ['class' => 'form-control']) }}
        @if ($errors->has('slug'))
        <div class="errors">
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
    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
</div>