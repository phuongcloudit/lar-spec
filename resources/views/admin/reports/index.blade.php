<?php 
	$orderby 	= trim(Request::query('orderby'));
	$order 		= trim(Request::query('order'))=="ASC"?"DESC":"ASC";
	$sort_icon  = '<i class="fas fa-sort-amount-down'.($order=="DESC"?"-alt":"") .'"></i> ';
    $category_name = trim(Request::query('category_name'));
    $report_type_name = trim(Request::query('report_type_name'));
?>
@extends('admin.layouts.master') @section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>募金現場レポート</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">募金現場レポート</li>
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
                {!! Form::open(['method' => 'GET', 'route'=>['admin.reports.index']]) !!}

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
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                <a href="{{ Request::fullUrlWithQuery(['orderby' => 'title', 'order'	=>	$order]) }}">{!! $orderby=="title"?$sort_icon:"" !!}Title</a>
                                </th>
                                <th style="width: 10%;" class="text-right">
                                    Author
                                </th>
                                <th style="width: 10%;" class="text-right">
                                <a href="{{ Request::fullUrlWithQuery(['orderby' => 'project_category_id', 'order'	=>	$order]) }}">{!! $orderby=="project_category_id"?$sort_icon:"" !!}カテゴリー</a>
                                </th>
                                <th style="width: 15%;" class="text-right">
                                <a href="{{ Request::fullUrlWithQuery(['orderby' => 'report_type_id', 'order'	=>	$order]) }}">{!! $orderby=="report_type_id"?$sort_icon:"" !!}ReportType</a>
                                </th>
                                <th style="width: 15%;" class="text-right">
                                <a href="{{ Request::fullUrlWithQuery(['orderby' => 'status', 'order'	=>	$order]) }}">{!! $orderby=="status"?$sort_icon:"" !!}ステータス</a>
                                </th>
                                <th style="width: 15%;" class="text-right">
                                <a href="{{ Request::fullUrlWithQuery(['orderby' => 'featured', 'order'	=>	$order]) }}">{!! $orderby=="name"?$sort_icon:"" !!}注目のプロジェクト</a> 
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $report)
                            <tr>
                                <td>
                                    <a class="post-title" target="_blank" href="{{ route('reports.detail',['slug'=> $report->slug]) }}"><b>{{ $report->title }}</b></a>
                                    <br />
                                    <small>最後の更新は<b>{{ $report->updated_at->format("Y年n月j日 g:i A")}}</b></small>
                                </td>
                                <td class="text-right">
                                        @if (empty($report->author))
                                        {{ $report->user->name }}
                                        @else
                                        {{ $report->author }}
                                        @endif
                                </td>
                                <td class="text-right">
                                     <a href="{{ route('admin.reports.index',['category_name'   =>  $report->project_category->slug ]) }}">
                                        {{ $report->project_category->name }}
                                    </a>
                                </td>
                                <td class="text-right">
                                <a href="{{ route('admin.reports.index',['report_type_name'   =>  $report->report_type->slug ]) }}">
                                        {{ $report->report_type->name }}
                                    </a>
                                </td>
                                <td class="text-right">
                                    {{ $report->statusName }}<br/>
                                   <small>{{ $report->created_at->format("Y年n月j日 g:i A")}}</small>
                                </td>
                                <td class="text-center" style="color: #3490dd;">
                                    <button class="btn btn-{{ !$report->featured?'outline-':'' }}success btn-sm featured" data-switch_url="{{ route('admin.reports.featured', $report) }}" data-featured="{{ $report->featured }}">
		                        		<i class="{{ $report->featured?'fas':'far' }} fa-star"></i>
		                        	</button>
                                </td>
                                <td class="project-actions text-right">
                                    <a target="_blank" class="btn btn-outline-primary btn-sm" href="{{ route('reports.detail',['slug'=> $report->slug]) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a class="btn btn-success btn-sm" href="{{ route('admin.reports.edit', $report) }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    {!! Form::open(['method' => 'DELETE', 'route'=>['admin.reports.destroy',
                                    $report->id], 'style'=> 'display:inline', 'title' => 'Delete']) !!}
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
            {{ $reports->appends(Request::query())->render() }}
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