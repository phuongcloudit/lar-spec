@extends('admin.layouts.master')

@section('title', 'カテゴリー')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>カテゴリー</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">カテゴリー</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        @include("admin.includes.message")
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body p-0">
                    {!! Form::open(['route' => 'admin.report-types.store', 'method' => 'POST']) !!}
                        @include('admin.report-types._form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-body">
                        <div class="rows">
                            <div class="col-md-6 offset-md-6" >
                                {!! Form::open(['method'=>'GET',    'route'=>['admin.report-types.index'],'style'=> 'display:inline', 'title' => 'Search'])
                                !!}
                                <div class="input-group mb-3">
                                    <input type="text" name="report_type_name" class="form-control" placeholder="キーワードを入力..." aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary p-20" type="submit"> &nbsp&nbsp&nbsp<i class="fas fa-search"></i> &nbsp&nbsp</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped projects">
                                <thead>
                                    <tr>
                                        <th style="width: 20%">カテゴリー名</th>
                                        <th style="width: 20%">カテゴリー数</th>                                    
                                        <th>Description</th>
                                        <th style="width: 15%">Slug</th>
                                        <th class="text-center" style="width: 160px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($types as $type)
                                    <tr>
                                        <td>
                                            <a class="post-title"  href="{{ route('admin.reports.index',['report_type_name'   => $type->slug ]) }}"> {{ $type->name }}</a>
                                        </td>
                                        <td>
                                                {{ $type->total_reports }}
                                        </td>
                                        <td>
                                            {{ $type->description }}
                                        </td>
                                        <td>
                                            {{ $type->slug }}
                                        </td>
                                        <td class="text-right">
                                            <a  target="_blank" class="btn btn-primary btn-sm" href="{{ route('reports.type',['slug'=> $type->slug]) }}" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a class="btn btn-success btn-sm" href="{{ route('admin.report-types.edit', $type->id) }}" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            {!! Form::open(['method' => 'DELETE', 'route'=>['admin.report-types.destroy', $type->id],
                                            'style'=> 'display:inline', 'title' => 'Delete'])
                                            !!}
                                            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> ',
                                            ['class' => 'btn btn-danger btn-sm delete-confirm', 'name' => 'submit', 'type' => 'submit']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

</section>

@endsection