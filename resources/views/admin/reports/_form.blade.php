<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('title', "募金プロジェクト") }}
                    {{ Form::text('title', null, ['class' => 'form-control']) }}
                    @if ($errors->has('name'))
                    <div class="alert alert-danger">{{$errors->first('title')}}</div>
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
                        {{ Form::label('status', "ステータス") }}
                        {!! Form::select('status', ["publish"   =>  "公開" ,"draft"    =>  "下書き"], old('status', $report->status?:'publish'), ['class' => 'form-control custom-select']) !!}
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="featured" value="1" {{ old('featured',$report->featured)?'checked':'' }}>
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
                                <a href="{{ route('admin.reports.index') }}"
                                    class="btn btn-outline-secondary  btn-block cancel-update"><i
                                        class="fas fa-arrow-left"></i> キャンセル</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('user_id', "Author") }}
                    {!! Form::select('user_id', $users, old('user_id', $report->users), ['class' => 'form-control custom-select']) !!}
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="custom_author" value="1">
                        Custom Author
                    </label>
                </div>
                <div class="form-group">
                    {{ Form::label('author', "Author: ") }}
                    {{ Form::text('author', null, array('class' => 'form-control',  'minlength' => '5')) }}
                    @if ($errors->has('author'))<div class="alert alert-danger">{{$errors->first('author')}}</div>@endif
                </div>

            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('project_category_id', "カテゴリー") }}
                    {!! Form::select('project_category_id', $projectCategories, null, ['class' => 'form-control
                    custom-select']) !!}
                    @if ($errors->has('project_category_id'))<div class="alert alert-danger">
                        {{$errors->first('project_category_id')}}</div>@endif
                </div>
                <div class="form-group">
                    {{ Form::label('report_type_id', "Report type") }}
                    {!! Form::select('report_type_id', $reportTypes, null, ['class' => 'form-control custom-select'])
                    !!}
                    @if ($errors->has('report_type_id'))<div class="alert alert-danger">
                        {{$errors->first('report_type_id')}}</div>@endif
                </div>
                <div class="form-group">
                    {{ Form::label('date', "募集終了まで") }}
                    @if($report->exists)
                    {{ Form::date('date', Carbon\Carbon::parse($report->date)->format('yy-m-d'), ['class' => 'form-control']) }}
                    @else
                    {{ Form::date('date', Carbon\Carbon::now(), ['class' => 'form-control']) }}
                    @endif
                    @if ($errors->has('date'))<div class="alert alert-danger">{{$errors->first('date')}}</div>@endif
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label>アバター画像</label>
                    <div class="select-media" data-input="#thumbnail" data-preview="#thumbnail-preview"
                        data-multiple="false">
                        <span>アバター画像選択</span>
                    </div>
                    <input type="hidden" class="form-control" name="thumbnail" id="thumbnail"
                        value="{{ old('status', $report->thumbnail) }}">
                    <div id="thumbnail-preview">
                        @if(old('thumbnail',$report->thumbnail))
                        <img src="{{ old('thumbnail',$report->thumbnail) }}">
                        @endif
                    </div>
                    <div class="delete-media" data-input="#thumbnail" data-preview="#thumbnail-preview">
                        アバター画像削除
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include("admin.includes.media")