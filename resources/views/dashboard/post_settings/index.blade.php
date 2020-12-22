@extends('dashboard.layouts.app')

@section('title')
Category & Tag Settings
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Category & Tag Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            
            @include('dashboard.post_settings.alert')

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="table-responsive">
                                <a href="{{ route('create-category' )}}" class="btn btn-sm btn-flat btn-info">Add Category</a>
                                <br><br>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Created at</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                        <tbody>
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ $category->created_at->format('d M, Y') }}</td>
                                                    <td>
                                                        <a href="{{ route('edit-category', $category->slug) }}" class="btn btn-sm btn-flat btn-success">Edit</a>
                                                        <form action="{{ route('delete-category', $category->slug) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('delete')

                                                            <button type="submit" class="btn btn-sm btn-flat btn-danger">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="table-responsive">
                                <a href="{{ route('create-tag' )}}" class="btn btn-sm btn-flat btn-info">Add Tag</a>
                                <br><br>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Created at</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                        <tbody>
                                            @foreach ($tags as $tag)
                                                <tr>
                                                    <td>{{ $tag->name }}</td>
                                                    <td>{{ $tag->created_at->format('d M, Y') }}</td>
                                                    <td>
                                                        <a href="{{ route('edit-tag', $tag->slug) }}" class="btn btn-sm btn-flat btn-success">Edit</a>
                                                        <form action="{{ route('delete-tag', $tag->slug) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('delete')

                                                            <button type="submit" class="btn btn-sm btn-flat btn-danger">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection