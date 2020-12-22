@extends('layouts.app')

@section('title')
    Edit Profile Picture
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
                                Edit Profile Picture
                            </div>
                            <div>
                                <a href="{{ route('settings', $user->username) }}" class="btn btn-sm btn-success">Cancel</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update-photo', $user->username) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('patch')

                                <div class="form-group">
                                    <label for="photo">Profile Picture</label>
                                    <input type="file" name="photo" id="photo" class="form-control-file @error('photo') is-invalid @enderror">
                                    @error('photo')
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