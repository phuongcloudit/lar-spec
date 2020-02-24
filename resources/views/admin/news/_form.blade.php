<div class="card-body">
    <div class="form-group">
        {{ Form::label('date_time', "Date time") }}
        {{ Form::text('date_time', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('news_type', "New Type:") }}
        {{ Form::text('news_type', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('news_content', "Content:") }}
        {{ Form::textarea('news_content', null, ['class' => 'form-control']) }}
    </div>

</div>
<div class="card-footer">
    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
</div>