@extends('dashboard.layouts.app')

@section('title')
User Settings
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            
            <div class="col-12">
                @if (session()->has('create'))
                    <div class="alert alert-success alert-dismissible mt-2" role="alert">
                        {{ session()->get('create') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="table-responsive">
                                <a href="{{ route('create-user' )}}" class="btn btn-sm btn-flat btn-info">Add User</a>
                                <br><br>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                        <tbody>
                                            @foreach ($users as $user)
                                                @foreach ($user->roles as $roles)
                                                    @if ($roles->name == 'user')
                                                        <tr>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->username }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $roles->name }}</td>
                                                            <td>
                                                                <a href="{{ route('user-edit', $user->username) }}" class="btn btn-sm btn-flat btn-success">Edit</a>
                                                                <form action="{{ route('delete-user', $user->username) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button class="btn btn-sm btn-flat btn-danger" type="submit">Delete</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
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