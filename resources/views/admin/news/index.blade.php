@extends('admin.layouts.master')

@section('title', 'Admin CP | All News')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>News</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">News</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <!-- Default box -->
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">
                            #
                        </th>
                        <th style="width: 12%">
                            ID
                        </th>
                        <th>
                            Datetime
                        </th>
                        <th>
                            News Type
                        </th>
                        <th style="width: 20%" class="text-center">
                            Content
                        </th>
                        <th>
                            Created at
                        </th>
                        <th style="width: 25%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($news as $news_item)
                    <tr>
                        <td>
                            #
                        </td>
                        <td>
                           {{ $news_item->id }}
                        </td>
                        <td>
                            {{ $news_item->date_time }}
                        </td>
                        <td>
                            {{ $news_item->news_type }}
                        </td>
                        <td>
                            {{ $news_item->news_content }}
                        </td>
                        <td>
                            {{ $news_item->created_at }}
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-sm" href="" title="View">
                                <i class="fas fa-eye"></i>
                            </i>
                            </a>
                            <a class="btn btn-success btn-sm" href="{{ route('admin.news.edit', $news_item->id) }}" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            {!! Form::open(['method' => 'DELETE', 'route'=>['admin.news.destroy', $news_item->id],
                            'style'=> 'display:inline', 'title' => 'Delete'])
                            !!}
                            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> ',
                            ['class' => 'btn btn-danger btn-sm', 'name' => 'submit', 'type' => 'submit']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>

@endsection