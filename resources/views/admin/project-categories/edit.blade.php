@extends('admin.layouts.master')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Category Edit</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Category Edit</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        @include("admin.includes.message")
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    {!! Form::model($project_category, ['method'=>'PATCH','route'=>['admin.project-categories.update', $project_category]])!!}
                    @include('admin/project-categories/_form')
                    {!! Form::close() !!}

                </div>
            </div>
            <div class="col-md-6">

            </div>
        </div>
    </div>
</section>
@endsection