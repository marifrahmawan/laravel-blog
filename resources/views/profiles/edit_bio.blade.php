@extends('layouts.app')

@section('title')
    Edit Profile Bio
@endsection

@section('content')
    
    <div class="container my-4">
        <div class="jumbotron">
            
            @include('includes.alert')
            
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
                                Edit Profile Bio
                            </div>
                            <div>
                                <a href="{{ route('settings', $user->username) }}" class="btn btn-sm btn-success">Cancel</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update-bio', $user->username) }}" method="POST">
                                @csrf
                                @method('patch')
                                
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $user->name }}" autocomplete="off" autofocus>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') ?? $user->username }}" autocomplete="off" autofocus>
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select name="gender" id="gender" class="form-control  @error('gender') is-invalid @enderror">
                                        <option selected disabled hidden>Choose Gender</option>
                                        <option value="Male" @if ($user->gender == "Male") selected @endif>Male</option>
                                        <option value="Female" @if ($user->gender == "Female") selected @endif>Female</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="birth_date">Birth Date</label>
                                    <input type="text" name="birth_date" id="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date') ?? $user->birth_date }}" autocomplete="off" autofocus>
                                    @error('birth_date')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="username">Email</label>
                                    <input type="text" name="email" id="name" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') ?? $user->email }}" autocomplete="off" autofocus>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                </div>
                            </form>
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