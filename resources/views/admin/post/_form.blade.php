<div class="card-body">
    <div class="form-group">
        {{ Form::label('title', "Title") }}
        {{ Form::text('title', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
      {{ Form::label('slug', "Slug: ") }}
      {{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5')) }}
  </div>
    <div class="row">
      <div class="col-12 col-md-12 col-lg-6">
        <div class="form-group">
          {{ Form::label('images', "Photo") }}
          {{ Form::file('images[]', ['accept' => 'image/*', 'multiple','class' => 'imgs form-control']) }} 

           {{-- @foreach ($images as $img)
           <span class="pip"><img class="imageThumb" src="{{ asset('/images/') }}/{{ $img->image_name }}"><br>
              <span class="remove"><i class="fas fa-trash-alt"></i></span>
            </span>
            @endforeach --}}

        </div>
      </div>
      <div class="col-12 col-md-12 col-lg-6">
        <div class="form-group">
          {{ Form::label('category_id', "Category") }}
          {!! Form::select('category_id', $categories, null, ['class' => 'form-control custom-select']) !!}
      
      </div>
      <div class="form-group">
          {{ Form::label('donate_day_end', "募集終了まで (Donate day amount)") }}
          {{   Form::date('donate_day_end', \Carbon\Carbon::now(), ['class' => 'form-control']) }}
      </div>
      </div>
    </div>
    {{-- <div class="form-group">
        <h3>Upload  images</h3>
        <input type="file" class="files" name="files[]" multiple class="form-control"/>
        <input type="file" class="files" name="files[]" multiple class="form-control"/>
    </div> --}}
    <div class="form-group">
        {{ Form::label('content', "Content") }}
        {!! Form::textarea('content', null, ['id' => 'content', 'class' => 'form-control' ]) !!}
      </div>
</div>

