@extends('admin.layouts.master')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>News  新規追加</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">News</a></li>
                    <li class="breadcrumb-item active">新規追加</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        {!! Form::open(['route' => 'admin.posts.store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => "fileUpload"]) !!}
        @include('admin.posts._form')
        {!! Form::close() !!}
    </div>
</section>
@endsection