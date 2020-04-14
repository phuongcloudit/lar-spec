@extends('admin.layouts.master') @section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>募金プロジェクト</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">募金プロジェクト</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <!-- Default box -->
    <div class="card">
        <div class="card-body p-0">
        	<div class="table-responsive">
	            <table class="table table-striped projects">
	                <thead>
	                    <tr>
	                        <th> プロジェクト名</th>
	                        <th style="width: 160px">カテゴリー</th>
	                        <th style="width: 160px"  class="text-right">募金された金額合計</th>
	                        <th style="width: 180px"></th>
	                    </tr>
	                </thead>
	                <tbody>
	                    @foreach($posts as $post)
	                    <tr>
	                        <td>
	                            <a class="post-title" target="_blank" href="{{ route('post.detail',['slug'=> $post->slug]) }}"><b>{{ $post->title }}</b></a>
	                            <br/>
	                            <small><b>{{$post->auth_name}}</b>によって<b>{{ $post->created_at->format("Y年n月j日 g:i A")}}</b>に作成されました。 最後の更新は <b>{{ $post->updated_at->format("Y年n月j日 g:i A")}}</b></small>
	                        </td>
	                        <td>
	                            {{ $post->category->name }}
	                        </td>
	                        <td class="text-right">
	                            {{ $post->total_donated_format }} 円
	                        </td>
	                        <td class="project-actions text-right">
	                            <a target="_blank" class="btn btn-outline-primary btn-sm" href="{{ route('post.detail',['slug'=> $post->slug]) }}">
	                                <i class="fas fa-eye"></i>
	                            </a>
	                            <a class="btn btn-outline-success btn-sm" href="{{ route('admin.posts.donate',$post) }}">
	                                <i class="fas fa-hand-holding-usd"></i>
	                            </a>
	                            <a class="btn btn-success btn-sm" href="{{ route('admin.posts.edit', $post) }}">
	                                <i class="fas fa-edit"></i>
	                            </a>
	                            {!! Form::open(['method' => 'DELETE', 'route'=>['admin.posts.destroy', $post->id], 'style'=> 'display:inline', 'title' => 'Delete']) !!} 
	                            	{!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> ', ['class' => 'btn btn-danger btn-sm delete-confirm', 'name' => 'submit', 'type' => 'submit']) !!} 
	                            {!! Form::close() !!}
	                        </td>
	                    </tr>
	                    @endforeach
	                </tbody>
	            </table>
	        </div>
        </div>
        <!-- /.card-body -->
    </div>
    <div class="text-right">
        <?php echo $posts->render(); ?>
    </div>
    <!-- /.card -->

</section>

@stop