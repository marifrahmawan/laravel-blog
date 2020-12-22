@extends('layouts.app')

@section('title')
    Edit Profile
@endsection

@section('content')
    
    <div class="container my-4">
        <div class="jumbotron">
            @if (session()->has('update'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('update') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>    
            @endif

            @if (session()->has('update_photo'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('update_photo') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>    
            @endif

            @if (session()->has('update_password'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('update_password') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>    
            @endif
            
            <div class="row">
                <div class="col-3">
                    <div class="card shadow">
                        <div class="card-header">Profile</div>
                        <div class="card-body text-center">
                            @if ($user->photo != NULL)
                                <img src="{{ Storage::url($user->photo) }}" width="120px" height="120px" class="rounded-circle">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ $user->username }}" width="120px" class="rounded-circle">
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="text-secondary text-left">Name</div>
                                <div class="text-right">{{ $user->name }}</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="text-secondary text-left">Username</div>
                                <div class="text-right">{{ $user->username }}</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="text-secondary text-left">Gender</div>
                                <div class="text-right">{{ $user->gender }}</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="text-secondary text-left">Birth Date</div>
                                <div class="text-right">{{ \Carbon\Carbon::createFromDate($user->birth_date)->format('d M, Y') }}</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="text-secondary text-left">Star</div>
                                <div class="text-right">200 <span class="far fa-star"></span></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="text-secondary text-left">Dislikes</div>
                                <div class="text-right">30 <span class="far fa-thumbs-down"></span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-9">
                    <div class="card shadow">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                Profile Settings
                            </div>
                            <div>
                                <a href="{{ route('my-profile', $user->username) }}" class="btn btn-sm btn-success">Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('edit-bio', $user->username) }}">Change Profile Bio</a><hr>
                            <a href="{{ route('edit-photo', $user->username) }}">Change Profile Picture</a><hr>
                            <a href="{{ route('change-password', $user->username) }}">Change Password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('addon-style')
    <link rel="stylesheet" href="{{ url('css/gijgo/gijgo.min.css') }}">
@endpush

@push('addon-script')
    <script src="{{ url('js/gijgo/gijgo.min.js') }}"></script>
    <script>
        $('#birth_date').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            format: 'yyyy-mm-dd',
        });
    </script>
@endpush