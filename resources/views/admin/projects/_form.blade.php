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
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>アバター画像</label>
                            <div class="select-media" data-input="#thumbnail" data-preview="#thumbnail-preview"  data-multiple="false">
                                <span>アバター画像選択</span>
                            </div>
                            <input type="hidden" class="form-control" name="thumbnail" id="thumbnail" value="{{ old('status', $project->thumbnail) }}">
                            <div id="thumbnail-preview">
                                @if(old('thumbnail',$project->thumbnail))
                                <img src="{{ old('thumbnail',$project->thumbnail) }}">
                                @endif
                            </div>
                            <div class="delete-media" data-input="#thumbnail" data-preview="#thumbnail-preview">
                               アバター画像削除
                            </div>
                        </div>
                    </div>
                     <div class="col-md-8">
                        <div class="form-group">
                            <label>ギャラリー</label>
                            <div class="select-media" data-input="#galleries" data-preview="#galleries-preview" data-multiple="true" data-size="file">
                                <span>ギャラリーに追加する</span>
                            </div>
                            <input type="hidden" class="form-control" name="galleries" id="galleries" value="{{ old('status', $project->galleries) }}">
                            <div id="galleries-preview" class="list-preview" data-input="#galleries" data-preview="#galleries-preview">
                                @if($project->gallery)
                                    @foreach ($project->gallery as $gallery)
                                    <div class="item">
                                        <img src="{{ $gallery }}" />
                                        <span class="remove"><i class="far fa-trash-alt"></i></span>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="delete-media" data-input="#galleries" data-preview="#galleries-preview">
                                ギャラリー削除
                            </div>
                        </div>
                    </div>
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
                
                @if($project->exists)
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5 offset-7">
                            <a  class="btn btn-success  btn-block" href="{{ route('project.detail',['slug'=> $project->slug]) }}" target="_blank">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                <div class="form-group">
                    <div class="form-group">
                        {{ Form::label('status', "ステータス") }}
                        {!! Form::select('status', ["publish"   =>  "公開" ,"draft"    =>  "下書き"], old('status', $project->status?:'publish'), ['class' => 'form-control custom-select']) !!}
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="featured" value="1" {{ old('featured',$project->featured)?'checked':'' }} >
                            注目のプロジェクト
                        </label>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                 {{ Form::button('<i class="fas fa-save"></i> Save', ['class' => 'btn btn-primary btn-block', 'type'=>'submit']) }}
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-outline-success btn-block" type="reset">
                                    <i class="fas fa-undo"></i> Reset
                                </button>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary  btn-block cancel-update"><i class="fas fa-arrow-left"></i>  キャンセル</a>
                            </div>
                        </div>
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
    </div>
</div>

@include("admin.includes.media")