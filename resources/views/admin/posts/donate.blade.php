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
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div style="padding: 0 15px;">
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
                        <h2 class="text-right">募金された金額合計: {{ $post->total_donated_format }} 円</h2>
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
                                    <tr @if($donate->state != 1) style="background: #fffdc5;" @endif>
                                        <td>{{ $donate->user_id }}</td>
                                        <td>{{ $donate->trans_code }}</td>
                                        <td>{{ $donate->payment_name }}</td>
                                        <td>{{ $donate->state }}</td>
                                        <td>{{ $donate->money }}  円</td>
                                         <td class="project-actions text-right">
                                            @if($donate->state == 1)
                                            {!! Form::open(['method' => 'PATCH', 'route'=>['admin.posts.donate.cancel', $donate], 'style'=> 'display:inline', 'title' => 'Delete']) !!} 
                                                {!! Form::button('<i class="fas fa-user-minus"></i>', ['class' => 'btn btn-warning btn-sm delete-confirm', 'name' => 'submit', 'type' => 'submit']) !!} 
                                            {!! Form::close() !!}
                                            @else
                                            {!! Form::open(['method' => 'PATCH', 'route'=>['admin.posts.donate.confirm', $donate], 'style'=> 'display:inline', 'title' => 'Delete']) !!} 
                                                {!! Form::button('<i class="fas fa-hand-holding-usd"></i>', ['class' => 'btn btn-success btn-sm donate-confirm', 'name' => 'submit', 'type' => 'submit']) !!} 
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
</section>

@stop