@extends('admin.layouts.master')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Posts/Project Add</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Posts/Project Add</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
    {!! Form::open(['route' => 'admin.posts.store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => "fileUpload"]) !!}
    @csrf
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
                <div class="card card-primary">
                    @include('admin.posts._form')
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-3 order-1 order-md-2">
                <div class="text-center mt-5 mb-3">
                      {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                    <a href="#" class="btn btn-warning">Cancel</a>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</section>
@endsection