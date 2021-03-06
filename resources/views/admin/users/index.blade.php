@extends('admin.layouts.master')
@section('title', '| All User')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>All Users</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">All Users</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">
                            #
                        </th>
                        <th style="width: 20%">
                            User Name
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Role
                        </th>
                        <th style="width: 15%" class="text-center">
                            Registered at
                        </th>
                        <th style="width: 25%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                        {{ $user->id }}
                        </td>
                        <td>
                            <a>
                            {{ $user->name }}
                            </a>
                        </td>
                        <td>
                        {{ $user->email }}
                        </td>
                        <td>
                  
                        </td>
                        <td class="project-state">
                            {{ $user->created_at }}
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-sm" href="#" title="View">
                                <i class="fas fa-eye"></i>
                                </i>
                            </a>
                            <a class="btn btn-success btn-sm" href="{{ route('admin.users.edit', $user) }}" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-danger btn-sm" href="#" title="Delete">
                                <i class="fas fa-trash">
                                </i>
                            </a>
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