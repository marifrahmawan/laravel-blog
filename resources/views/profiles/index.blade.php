@extends('layouts.app')

@section('title')
    Profile
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
                        <div class="card-footer">
                            <a href="{{ route('settings', $user->username) }}" class="btn btn-sm btn-flat btn-success">Settings <span class="fas fa-cogs"></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-9">
                    <div class="card shadow">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                My Posts
                            </div>
                            <div>
                                <a href="{{ route('posts-create') }}" class="btn btn-sm btn-primary">Add Post</a>
                            </div>
                        </div>
                        <div class="card-body">
                            @forelse($posts as $post)
                                <div class="card mb-3">
                                    
                                    <div class="card-header">
                                        {{ Str::limit($post->title, 66, '...') }}
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-2">
                                            {{ strip_tags(html_entity_decode(Str::limit( $post->body, 100, '...'))) }}
                                        </div>
                                        <a href="{{ route('posts-show', $post->slug) }}">Read More ...</a>
                                    </div>
                                    <div class="card-footer d-flex justify-content-end">
                                        <div>
                                            <a href="{{ route('posts-edit', $post->slug) }}" class="btn btn-sm btn-success">Edit</a>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-sm btn-danger ml-2" data-toggle="modal" data-target="#modal_delete">Delete</button>
                                        </div>
                                    </div>
                                    
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="modal_delete" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modal_delete">Are you sure ?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Delete {{ $post->title }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                                    <form action="{{ route('posts-delete', $post->slug) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="btn-group float-rigt" role="group">
                                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 card-body alert-info text-center">
                                    You haven't created a post yet
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection