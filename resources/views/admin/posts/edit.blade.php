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
        <div class="row">
            <div class="col-12 col-md-12 col-lg-9 order-2 order-md-1">
                <div class="card card-primary">
                    @include('admin.posts._form')
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-3 order-1 order-md-2">
            <div class="text-center mt-5 mb-3">
                    {!! Form::button('<i class="fas fa-save"></i> Save', ['class' => 'btn btn-primary', 'name' => 'submit', 'type' => 'submit']) !!} 
                    <a  class="btn btn-success" href="{{ route('post.detail',['slug'=> $post->slug]) }}" target="_blank">
                        <i class="fas fa-eye"></i> View
                    </a>
                    <a href="#" class="btn btn-warning"><i class="fas fa-trash"></i> Cancel</a>
                </div>
                <h3 class="text-primary"><i class="fas fa-paint-brush"></i> Infomation</h3>
                <div class="text-muted">
                    <p class="text-sm">Author:
                        <b class="d-block">Deveint Inc</b>
                    </p>
                    <p class="text-sm">Url:
                        <b class="d-block">
                            
                        </b>
                    </p>
                    <p class="text-sm">Posted at:
                        <b class="d-block">{{ $post->created_at }}</b>
                    </p>
                    <p class="text-sm">Updated at:
                        <b class="d-block">{{ $post->updated_at }}</b>
                    </p>
                    <p class="text-sm">Category:
                        <b class="d-block">{{ $post->category->name }}</b>
                    </p>
                </div>
               
            </div>

        </div>
        {!! Form::close() !!}

    </div>
</section>
@endsection