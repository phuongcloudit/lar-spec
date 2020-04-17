 <div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('name', "募金プロジェクト") }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                    @if ($errors->has('name'))
                        <div class="alert alert-danger">{{$errors->first('name')}}</div>
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::label('slug', "Slug: ") }}
                    {{ Form::text('slug', null, array('class' => 'form-control',  'minlength' => '5')) }}
                    @if ($errors->has('slug'))<div class="alert alert-danger">{{$errors->first('slug')}}</div>@endif
                </div>
                <div class="form-group">
                    {{ Form::label('content', "Content") }}
                    {!! Form::textarea('content', null, ['id' => 'content', 'class' => 'form-control' ]) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <div class="form-group">
                        {{ Form::label('status', "カテゴリー") }}
                        {!! Form::select('status', ["publish"   =>  "Công khai" ,"draft"    =>  "Nháp"], old('status', $post->status?:'publish'), ['class' => 'form-control custom-select']) !!}
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="featured" value="1" {{ old('featured',$project->featured)?'checked':'' }} >
                            注目のプロジェクト
                        </label>
                    </div>
                    <div class="form-group">
                    @if($project->exists)
                        <div class="row">
                            <div class="col-md-4">
                                 {{ Form::button('<i class="fas fa-save"></i> Save', ['class' => 'btn btn-primary btn-block', 'type'=>'submit']) }}
                            </div>
                            <div class="col-md-4">
                                <a  class="btn btn-success  btn-block" href="{{ route('project.detail',['slug'=> $project->slug]) }}" target="_blank">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary  btn-block cancel-update"><i class="fas fa-undo"></i> キャンセル</a>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-6">
                                 {{ Form::button('<i class="fas fa-save"></i> Save', ['class' => 'btn btn-primary btn-block', 'type'=>'submit']) }}
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary  btn-block cancel-create"><i class="fas fa-undo"></i> キャンセル</a>
                            </div>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('project_category_id', "カテゴリー") }}
                    {!! Form::select('project_category_id', $projectCategories, null, ['class' => 'form-control custom-select']) !!}
                    @if ($errors->has('project_category_id'))<div class="alert alert-danger">{{$errors->first('project_category_id')}}</div>@endif
                </div>
                <div class="form-group">
                    {{ Form::label('end_time', "募集終了まで") }}
                    @if($project->exists)
                        {{ Form::date('end_time', Carbon\Carbon::parse($project->end_time)->format('yy-m-d'), ['class' => 'form-control']) }}
                    @else
                        {{ Form::date('end_time', Carbon\Carbon::now(), ['class' => 'form-control']) }}
                    @endif
                    @if ($errors->has('end_time'))<div class="alert alert-danger">{{$errors->first('end_time')}}</div>@endif
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('thumbnail', "Photo") }}
                    {{ Form::file('thumbnail', ['accept' => 'image/*', 'multiple','class' => 'imgs form-control']) }}
                </div>
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
        </div>
    </div>
</div>