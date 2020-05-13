@extends('admin.layouts.master')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Report Create</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.reports.index') }}">Reports</a></li>
                    <li class="breadcrumb-item active">新規追加</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        {!! Form::open(['route' => 'admin.reports.store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => "fileUpload"]) !!}
        @include('admin.reports._form')
        {!! Form::close() !!}
    </div>
</section>
@endsection