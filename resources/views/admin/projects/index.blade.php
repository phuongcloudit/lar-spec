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
	<div class="container-fluid">
	@include("admin.includes.message")
    <!-- Default box -->
	    <div class="card">
	        <div class="card-body p-0">
	        	<div class="table-responsive">
		            <table class="table table-striped projects">
		                <thead>
		                    <tr>
		                        <th> プロジェクト名</th>
		                        <th style="width: 160px">カテゴリー</th>
		                        <th style="width: 160px"  class="text-right">募金総額</th>
	                        	<th style="width: 100px" class="text-right">募金者数</th>
	                        	<th style="width: 100px" class="text-right"> Status </th>
		                        <th style="width: 160px">注目のプロジェクト</th>
		                        <th style="width: 180px"></th>
		                    </tr>
		                </thead>
		                <tbody>
		                    @foreach($projects as $project)
		                    <tr>
		                        <td>
		                            <a class="post-title" target="_blank" href="{{ route('project.detail',['slug'=> $project->slug]) }}"><b>{{ $project->name }}</b></a>
		                            <br/>
		                            <small><b>{{$project->auth_name}}</b>によって<b>{{ $project->created_at->format("Y年n月j日 g:i A")}}</b>に作成されました。 最後の更新は <b>{{ $project->updated_at->format("Y年n月j日 g:i A")}}</b></small>
		                        </td>
		                        <td>
		                        	<a href="{{ route('admin.projects.index',['category_name'   =>  $project->project_category->slug ]) }}" >
                                        {{ $project->project_category->name }}
                                    </a>
		                        </td>
		                        <td class="text-right">
		                            ¥{{ $project->total_donated_format }}
		                        </td>
		                         <td class="text-right">
		                            {{$project->TotalDonatedNumber}}人
		                        </td>
		                        <td class="text-right">
		                    		{{ $project->status }}
		                    	</td>
		                        <td class="text-center" style="color: #3490dd;">
		                        	<i class="{{ $project->featured?'fas':'far' }} fa-star"></i>
		                        </td>
		                        <td class="project-actions text-right">
		                            <a target="_blank" class="btn btn-outline-primary btn-sm" href="{{ route('project.detail',['slug'=> $project->slug]) }}">
		                                <i class="fas fa-eye"></i>
		                            </a>
		                            <a class="btn btn-outline-success btn-sm" href="{{ route('admin.projects.donate',$project) }}">
		                                <i class="fas fa-hand-holding-usd"></i>
		                            </a>
		                            <a class="btn btn-success btn-sm" href="{{ route('admin.projects.edit', $project) }}">
		                                <i class="fas fa-edit"></i>
		                            </a>
		                            {!! Form::open(['method' => 'DELETE', 'route'=>['admin.projects.destroy', $project->id], 'style'=> 'display:inline', 'title' => 'Delete']) !!} 
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
	        <?php echo $projects->render(); ?>
	    </div>
	    <!-- /.card -->
	</div>
</section>

@stop