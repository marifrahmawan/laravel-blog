@extends('dashboard.layouts.app')

@section('title')
Edit User
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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard-user') }}">User Settings</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-12">
                    @if (session()->has('update'))
                        <div class="alert alert-success alert-dismissible mt-2" role="alert">
                            {{ session()->get('update') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Edit : {{ $user->username }}</h3>
                        </div>

                        <form action="{{ route('update-user', $user->username) }}" method="POST">
                            <div class="card-body">
                                @csrf
                                @method('patch')

                                <div class="form-group col">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ?? $user->name }}" autofocus autocomplete="off">
                                    @error('name')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') ?? $user->username }}" autofocus autocomplete="off">
                                    @error('username')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group col">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') ?? $user->email }}" autofocus autocomplete="off">
                                    @error('email')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="form-group col">
                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- USER ROLE & PERMISSION --}}
                <div class="col">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Role & Permission : {{ $user->username }}</h3>
                        </div>

                        <form action="{{ route('update-role-user', $user->username) }}" method="POST">
                            @csrf
                            @method('patch')

                            <div class="card-body">
                                <div class="form-group col">
                                    <label for="role">Role</label>
                                    <select name="roles" class="form-control">
                                        <option hidden selected value="">Chose Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}"
                                                @foreach ($user->roles as $user_role)
                                                    @if ($role->name == $user_role->name)
                                                        selected
                                                    @endif
                                                @endforeach
                                            >
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-12">
                                    <label for="permission">Permission</label>
                                    <select multiple class="form-control permission" name="permission[]">
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->name }}"
                                                @foreach ($user->permissions as $user_permissions)
                                                    @if ($permission->name == $user_permissions->name)
                                                        selected
                                                    @endif
                                                @endforeach
                                            >
                                                {{ $permission->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="form-group col">
                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection

@push('prepend-style')
    <link href="{{ url('admin/plugins/select2/select2.css') }}" rel="stylesheet" />
    <style>
        .select2 {
            width:100%!important;
        }
    </style>
@endpush

@push('addon-script')
    <script src="{{ url('admin/plugins/select2/select2.js') }}"></script>
    <script src="{{ url('admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ url('admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.permission').select2({});
        });
    </script>
@endpush