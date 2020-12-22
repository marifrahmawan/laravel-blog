@extends('dashboard.layouts.app')

@section('title')
Admin Settings
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Admin</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
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
                                <a href="{{ route('create-admin' )}}" class="btn btn-sm btn-flat btn-info">Add Admin</a>
                                <br><br>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Role</th>
                                            @if (auth()->user()->hasRole('super-admin'))
                                                <th scope="col">Actions</th>
                                            @endif
                                        </tr>
                                        <tbody>
                                            @foreach ($users as $user)
                                                @foreach ($user->roles as $roles)
                                                    @if ($roles->name == 'super-admin' or $roles->name == 'admin')
                                                        <tr>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->username }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $roles->name }}</td>
                                                            @if (auth()->user()->hasRole('super-admin'))
                                                                <td>
                                                                    <a href="{{ route('user-edit', $user->username) }}" class="btn btn-sm btn-flat btn-success">Edit</a>
                                                                    <form action="{{ route('delete-admin', $user->username) }}" method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('delete')

                                                                        <button type="submit" class="btn btn-sm btn-flat btn-danger">Delete</button>
                                                                    </form>
                                                                </td>
                                                            @endif
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