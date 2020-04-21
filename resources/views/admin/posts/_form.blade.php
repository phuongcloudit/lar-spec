 <div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('title', "Title") }}
                    {{ Form::text('title', null, ['class' => 'form-control']) }}
                    @if ($errors->has('title'))
                        <div class="alert alert-danger">{{$errors->first('title')}}</div>
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::label('slug', "Slug: ") }}
                    {{ Form::text('slug', null, array('class' => 'form-control',  'minlength' => '5')) }}
                    @if ($errors->has('slug'))
                        <div class="alert alert-danger">{{$errors->first('slug')}}</div>
                    @endif
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
                    @if($post->exists)
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-5 offset-7">
                                <a  class="btn btn-success  btn-block" href="{{ route('post.detail',['slug'=> $post->slug]) }}" target="_blank">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        {{ Form::label('status', "ステータス") }}
                        {!! Form::select('status', ["publish"   =>  "公開" ,"draft"    =>  "下書き"], old('status', $post->status?:'publish'), ['class' => 'form-control custom-select']) !!}
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
                                <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary  btn-block cancel-update"><i class="fas fa-arrow-left"></i>  キャンセル</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                
                <div class="form-group">
                    {{ Form::label('date', "Date") }}
                    @if($post->exists)
                        {{ Form::date('date', $post->date->format('yy-m-d'), ['class' => 'form-control']) }}
                    @else
                        {{ Form::date('date', Carbon\Carbon::now(), ['class' => 'form-control']) }}
                    @endif
                    @if ($errors->has('date'))<div class="alert alert-danger">{{$errors->first('date')}}</div>@endif
                </div>
                <div class="form-group">
                    {{ Form::label('category_id', "カテゴリー") }}
                    {!! Form::select('category_id', $categories, null, ['class' => 'form-control custom-select']) !!}
                    @if ($errors->has('category_id'))
                        <div class="alert alert-danger">{{$errors->first('category_id')}}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include("admin.includes.media")