@extends('admin.layouts.master')
@section('content')
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

    <div style="padding: 0 15px;">
		@include("admin.includes.message")
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        プロジェクト名
                        <h3>{{ $post->title }}</h3>
                        <hr />
                        内容
                        <div>
                            {!! $post->content !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">募金された金額合計: {{ $post->total_donated_format }} 円</h3>
                        <div class="card-tools" style="float: right;">
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-hand-holding-usd"></i> 募金金額を追加</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped projects">
                                <thead>
                                    <tr>
                                        <th>ユーザーID</th>
                                        <th>トランザクションコード</th>
                                        <th>決済方法</th>
                                        <th>支払い状態</th>
                                        <th>価格</th>
                                        <th style="width: 180px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($post->donates as $donate)
                                    <tr @if($donate->state != 1) class="donate-canceled" @endif>
                                        <td>{{ $donate->user_id }}</td>
                                        <td>{{ $donate->trans_code }}</td>
                                        <td>{{ $donate->payment_name }}</td>
                                        <td>{{ $donate->state }}</td>
                                        <td>{{ $donate->money }}  円</td>
                                         <td class="project-actions text-right">
                                            @if($donate->state == 1)
                                            {!! Form::open(['method' => 'PUT', 'route'=>['admin.posts.donate.cancel', $donate], 'style'=> 'display:inline', 'title' => 'Delete']) !!} 
                                                {!! Form::button('<i class="fas fa-user-minus"></i> キャンセル', ['class' => 'btn btn-warning btn-sm donate-cancel', 'name' => 'submit', 'type' => 'submit']) !!} 
                                            {!! Form::close() !!}
                                            @else
                                            {!! Form::open(['method' => 'PUT', 'route'=>['admin.posts.donate.confirm', $donate], 'style'=> 'display:inline', 'title' => 'Delete']) !!} 
                                                {!! Form::button('<i class="fas fa-hand-holding-usd"></i> 募金金額を追加', ['class' => 'btn btn-success btn-sm donate-confirm', 'name' => 'submit', 'type' => 'submit']) !!} 
                                            {!! Form::close() !!}
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			{!! Form::open(['method' => 'POST', 'route'=>['admin.posts.donate.store', $post]]) !!} 
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">に募金する</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{{ Form::label('money', "金額入力") }}
        		{{ Form::text('money', null, ['type'=>'number', "pattern"=>"\d*", 'class' => 'form-control']) }}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
				{!! Form::button('<i class="fas fa-hand-holding-usd"></i> 確認', ['class' => 'btn btn-success donate-confirm', 'name' => 'submit', 'type' => 'submit']) !!} 
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

@stop
@push("stylesheets")
<style type="text/css">
	.donate-canceled{
		background-color: #f8d7da !important;
    	border-bottom: 2px solid #c71a2c;
	}
    
</style>
@endpush();

   
@push("scripts")
<script type="text/javascript">
	
	$(function(){
		$(".donate-confirm, .donate-cancel").click(function(){
			if(confirm("Are you sure?")){
				return true;
			}else{
				return false;
			}
		})
	})
</script>
@endpush()