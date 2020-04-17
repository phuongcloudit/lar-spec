@extends('admin.layouts.master')

@section('title', 'Admin CP | Edit Post')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>募金プロジェクト </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">募金プロジェクト</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        @include("admin.includes.message")
        {!! Form::model($project, ['method'=>'PATCH','route'=>['admin.projects.update', $project]])!!}
        @include('admin.projects._form')
        {!! Form::close() !!}

    </div>
</section>
@endsection