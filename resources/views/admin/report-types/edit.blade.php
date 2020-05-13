@extends('admin.layouts.master')

@section('title', '各プロジェクト')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>各プロジェクト</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">各プロジェクト</li>
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
                    {!! Form::model($report_type, ['method'=>'PATCH','route'=>['admin.report-types.update', $report_type]])!!}
                        @include('admin.report-types._form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
           
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

</section>

@endsection