@extends('admin.layouts.master')


@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Projects</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Projects</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
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
                      
                      <th style="width: 5%">
                          ID 
                      </th>
                      <th style="width: 20%">
                          Title
                      </th>
                      <th>
                         Author
                      </th>
                      <th>
                        Category
                      </th>
                      <th>
                        Updated at
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
              @foreach($posts as $post)
                  <tr>
                      <td>
                      {{ $post->id }}
                      </td>
                      <td>
                          <a> {{ $post->title }} </a> <br/>
                          <small> Posted at {{ $post->created_at }} </small>
                      </td>
                      <td>
                      </td>
                      <td>
                      {{ $post->category->name }}
                      </td>
                      <td>
                      {{ $post->updated_at }}
                      </td>
                      <td class="project-actions text-right">
                          <a class="btn btn-primary btn-sm" href="{{ route('post.show', $post->id) }}">
                              <i class="fas fa-folder">
                              </i>
                              View
                          </a>
                          <a class="btn btn-info btn-sm" href="{{ route('admin.post.edit', $post) }}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          {!! Form::open(['method' => 'DELETE', 'route'=>['admin.post.destroy', $post->id],
                            'style'=> 'display:inline'])
                            !!}
                            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> ' .'Delete',
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


    @stop