@extends('admin.layouts.master')

@section('title', 'Admin CP | Edit Post')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Posts/Project Edit</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Posts/Project Edit</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        @include("admin.includes.message")
        {!! Form::model($post, ['method'=>'PATCH','route'=>['admin.posts.update', $post->id]])!!}
        @include('admin.posts._form')
        {!! Form::close() !!}

    </div>
</section>
@endsection