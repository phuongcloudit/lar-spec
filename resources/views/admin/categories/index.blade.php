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
                        {!! Form::open(['route' => 'admin.categories.store', 'method' => 'POST']) !!}
                        @include('admin.categories._form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-body">
                        <div class="rows">
                            <div class="col-md-6 offset-md-6" >
                                {!! Form::open(['method'=>'GET',    'route'=>['admin.categories.index'],'style'=> 'display:inline', 'title' => 'Search'])
                                !!}
                                <div class="input-group mb-3">
                                    <input type="text" name="category_name" class="form-control" placeholder="キーワードを入力..." aria-describedby="basic-addon2">
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
                                        <th style="width: 300px;">Name</th>
                                        <th style="width: 300px;">プロジェクト数</th>                                    
                                        <th>Description</th>
                                        <th style="width: 200px;" >Slug</th>
                                        <th class="text-center" style="width: 160px;" >Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            <a target="_blank" class="post-title"  href="{{ url('') }}/category/{{ $category->slug }}"> {{ $category->name }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.posts.index',['category_name'   => $category->slug ]) }}" >
                                                {{ $category->total_posts }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $category->description }}
                                        </td>
                                        <td>
                                            {{ $category->slug }}
                                        </td>
                                        <td class="project-actions text-right">
                                            <a  target="_blank" class="btn btn-primary btn-sm" href="{{ url('') }}/category/{{ $category->slug }}" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a class="btn btn-success btn-sm" href="{{ route('admin.categories.edit', $category->id) }}" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            {!! Form::open(['method' => 'DELETE', 'route'=>['admin.categories.destroy', $category->id],
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