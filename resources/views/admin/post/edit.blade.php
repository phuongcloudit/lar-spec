@extends('admin.layouts.master')

@section('title', 'Admin CP | Edit Post')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Project Add</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Project Add</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
    {!! Form::model($post, ['method'=>'PATCH','route'=>['admin.post.update', $post->id]])!!}

        <div class="row">

            <div class="col-12 col-md-12 col-lg-9 order-2 order-md-1">
                @if(count($errors) > 0)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="card card-primary">
                    @include('admin.post._form')

                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-3 order-1 order-md-2">
            <div class="text-center mt-5 mb-3">
                      {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                    <a href="#" class="btn btn-warning">Cancel</a>
                </div>
                <h3 class="text-primary"><i class="fas fa-paint-brush"></i> Infomation</h3>
                <div class="text-muted">
                    <p class="text-sm">Author:
                        <b class="d-block">Deveint Inc</b>
                    </p>
                    <p class="text-sm">Url:
                    <b class="d-block"><a href="{{ url($post->slug) }}">{{ $post->slug }}</a></b>
                    </p>
                    <p class="text-sm">Posted at:
                        <b class="d-block">{{ $post->created_at }}</b>
                    </p>
                    <p class="text-sm">Updated at:
                        <b class="d-block">{{ $post->updated_at }}</b>
                    </p>
                    <p class="text-sm">Category:
                        <b class="d-block">{{ $post->updated_at }}</b>
                    </p>
                </div>
               
            </div>

        </div>
        {!! Form::close() !!}

    </div>
</section>
@endsection