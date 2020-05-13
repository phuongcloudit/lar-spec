<?php 
	$orderby 	= trim(Request::query('orderby'));
	$order 		= trim(Request::query('order'))=="ASC"?"DESC":"ASC";
	$sort_icon  = '<i class="fas fa-sort-amount-down'.($order=="DESC"?"-alt":"") .'"></i> ';
	$category_name = trim(Request::query('category_name'));
?>
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

<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 offset-8">
                {!! Form::open(['method' => 'GET', 'route'=>['admin.projects.index']]) !!}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <select class="custom-select" name="category_name">
                            <option value="">All</option>
                            @foreach($projectCategories as $cat)
                            <option value="{{ $cat->slug }}" {{ $category_name==$cat->slug?'selected':'' }}>
                                {{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {!! Form::text('s', Request::query('s'), array('class' => 'form-control', 'placeholder' =>
                    "キーワードを入力して検索")) !!}
                    <div class="input-group-append">
                        {!! Form::button('<i class="fa fa-search" aria-hidden="true"></i> 検索', ['class' => 'btn
                        btn-success', 'type' => 'submit']) !!}
                    </div>
                </div>


                {!! Form::close() !!}
            </div>
        </div>
    </div>
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
                                <th>
                                    <a href="{{ Request::fullUrlWithQuery(['orderby' => 'name', 'order'	=>	$order]) }}">{!!
                                        $orderby=="name"?$sort_icon:"" !!}プロジェクト名</a>
                                </th>
                                <th style="width: 160px">
                                    <a
                                        href="{{ Request::fullUrlWithQuery(['orderby' => 'project_category_id', 'order'	=>	$order]) }}">{!!
                                        $orderby=="project_category_id"?$sort_icon:"" !!}カテゴリー</a>
                                </th>
                                <th style="width: 160px" class="text-right">
                                    <a
                                        href="{{ Request::fullUrlWithQuery(['orderby' => 'money', 'order'	=>	$order]) }}">{!!
                                        $orderby=="money"?$sort_icon:"" !!}募金総額</a>
                                </th>
                                <th style="width: 120px" class="text-right">
                                    <a
                                        href="{{ Request::fullUrlWithQuery(['orderby' => 'donated', 'order'	=>	$order]) }}">{!!
                                        $orderby=="donated"?$sort_icon:"" !!}募金者数</a>
                                </th>
                                <th style="width: 120px" class="text-right">
                                    <a
                                        href="{{ Request::fullUrlWithQuery(['orderby' => 'status', 'order'	=>	$order]) }}">{!!
                                        $orderby=="status"?$sort_icon:"" !!}ステータス</a>
                                </th>
                                <th style="width: 180px">
                                    <a
                                        href="{{ Request::fullUrlWithQuery(['orderby' => 'featured', 'order'	=>	$order]) }}">{!!
                                        $orderby=="featured"?$sort_icon:"" !!}注目のプロジェクト</a></th>
                                <th style="width: 180px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                            <tr>
                                <td>
                                    <a class="post-title" target="_blank"
                                        href="{{ route('project.detail',['slug'=> $project->slug]) }}"><b>{{ $project->name }}</b></a>
                                    <br />
                                    <small><b>{{$project->auth_name}}</b>によって<b>{{ $project->created_at->format("Y年n月j日 g:i A")}}</b>に作成されました。
                                        最後の更新は <b>{{ $project->updated_at->format("Y年n月j日 g:i A")}}</b></small>
                                </td>
                                <td>
                                    <a
                                        href="{{ route('admin.projects.index',['category_name'   =>  $project->project_category->slug ]) }}">
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
                                    {{ $project->statusName }}
                                </td>
                                <td class="text-center" style="color: #3490dd;">
                                    <button
                                        class="btn btn-{{ !$project->featured?'outline-':'' }}success btn-sm featured"
                                        data-switch_url="{{ route('admin.projects.featured', $project) }}"
                                        data-featured="{{ $project->featured }}">
                                        <i class="{{ $project->featured?'fas':'far' }} fa-star"></i>
                                    </button>
                                </td>
                                <td class="project-actions text-right">
                                    <a target="_blank" class="btn btn-outline-primary btn-sm"
                                        href="{{ route('project.detail',['slug'=> $project->slug]) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a class="btn btn-outline-success btn-sm"
                                        href="{{ route('admin.projects.donate',$project) }}">
                                        <i class="fas fa-hand-holding-usd"></i>
                                    </a>
                                    <a class="btn btn-success btn-sm"
                                        href="{{ route('admin.projects.edit', $project) }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    {!! Form::open(['method' => 'DELETE', 'route'=>['admin.projects.destroy',
                                    $project->id], 'style'=> 'display:inline', 'title' => 'Delete']) !!}
                                    {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> ', ['class' => 'btn
                                    btn-danger btn-sm delete-confirm', 'name' => 'submit', 'type' => 'submit']) !!}
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
            {{ $projects->appends(Request::query())->render() }}
        </div>
        <!-- /.card -->
    </div>
</section>

@stop
@push("scripts")
<script type="text/javascript">
$(document).ready(function() {
    $(".featured").click(function() {
        _this = $(this)
        var featured = $(this).data("featured") ? 0 : 1,
            switch_url = $(this).data("switch_url")
        console.log(featured);
        $.ajax({
            url: switch_url,
            data: {
                featured: featured
            },
            type: 'POST',
            beforeSend: function(xhr) {
                _this.removeClass("btn-success");
                _this.addClass("btn-outline-success");
                _this.html(
                '<i class="fas fa-spinner"></i>'); // change the button text, you can also add a preloader image
            },
            success: function(data) {
                console.log(data);
                var fa = 'far';
                if (data.featured == 1) {
                    fa = 'fas';
                    _this.addClass("btn-success");
                    _this.removeClass("btn-outline-success");
                }
                _this.data("featured", data.featured)
                _this.html(`<i class="${fa} fa-star"></i>`);
            }
        })
    })
})
</script>
@endpush