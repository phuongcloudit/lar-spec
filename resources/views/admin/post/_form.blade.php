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
        {{ Form::label('images', "Photo") }}
        {{ Form::file('images[]', ['accept' => 'image/*', 'multiple','class' => 'form-control']) }} 
    </div>
    <div class="form-group">
        {{ Form::label('content', "Content") }}
        {!! Form::textarea('content', null, ['id' => 'content', 'class' => 'form-control' ]) !!}
      </div>
      {{-- <div class="col-lg-7">
        <!-- The fileinput-button span is used to style the file input field as button -->
        <span class="btn btn-success fileinput-button">
          <i class="glyphicon glyphicon-plus"></i>
          <span>Add files...</span>
          <input type="file" name="files[]" multiple />
        </span>
        <button type="submit" class="btn btn-primary start">
          <i class="glyphicon glyphicon-upload"></i>
          <span>Start upload</span>
        </button>
        <button type="reset" class="btn btn-warning cancel">
          <i class="glyphicon glyphicon-ban-circle"></i>
          <span>Cancel upload</span>
        </button>
        <button type="button" class="btn btn-danger delete">
          <i class="glyphicon glyphicon-trash"></i>
          <span>Delete selected</span>
        </button>
        <input type="checkbox" class="toggle" />
        <!-- The global file processing state -->
        <span class="fileupload-process"></span>
      </div>
      <table role="presentation" class="table table-striped">
        <tbody class="files"></tbody>
      </table> --}}
</div>
<!-- <div class="card-footer">
    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
</div> -->
