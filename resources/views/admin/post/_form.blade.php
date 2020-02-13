<div class="card-body">
    <div class="form-group">
        {{ Form::label('title', "Title") }}
        {{ Form::text('title', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('category_id', "Category") }}
        {!! Form::select('category_id', $categories, null, ['class' => 'form-control custom-select']) !!}
    
    </div>
    <div class="form-group">
        {{ Form::label('donate_money', "募金総額 (Donate money)") }}
        {{ Form::text('donate_money', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('donate_day_end', "募集終了まで (Donate day amount)") }}
        {{   Form::date('donate_day_end', \Carbon\Carbon::now(), ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('content', "Content") }}
        {!! Form::textarea('content', null, ['id' => 'content', 'class' => 'form-control' ]) !!}
    </div>
    <!-- <div class="form-group">
         @trix(\App\Model\Post::class, 'content')
    </div> -->
</div>
<!-- <div class="card-footer">
    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
</div> -->