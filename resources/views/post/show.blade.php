@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection


@section('content')
    <div class="container py-4">
        <h1>{{ $post->title }}</h1>

        <div class="text-secondary">
            Category 
            @foreach ($post->categories as $category)
                <a href="{{ route('category-show', $category->slug) }}" class="badge badge-warning"> {{ $category->name }}</a>
            @endforeach
        </div>

        <div class="text-secondary">
            Tags 
            @foreach ($post->tags as $tag)
                <a href="{{ route('tag-show', $tag->slug) }}" class="badge badge-info"> {{ $tag->name }}</a>
            @endforeach
        </div>
        
        
        <div class="text-secondary">
            Published on {{ $post->created_at->format('d M, Y') }}
        </div>
        
        <hr>

        @include('includes.alert')

        
        <div class="row justify-content-center">
            <div class="col-9">
                <div class="card mt-4">

                    @if ($post->thumbnail != NULL)
                        <img src="{{ Storage::url($post->thumbnail) }}" class="card-img-top" style="height: 400px; object-fit: cover; object-position: center;">
                    @endif

                    <div class="card-body shadow ">
                        {!! $post->body !!}
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card mt-4 shadow">
                    <div class="card-header">
                        Author
                    </div>
                    <div class="card-body text-center">
                        @if ($post->user->photo != NULL)
                        <img src="{{ Storage::url($post->user->photo) }}" width="150px" height="200px" class="rounded">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ $post->user->username }}" width="150px" height="200px" class="rounded">
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="text-secondary text-left">Name</div>
                            <div class="text-right">{{ $post->user->name }}</div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="text-secondary text-left">Username</div>
                            <div class="text-right">{{ $post->user->username }}</div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="text-secondary text-left">Gender</div>
                            <div class="text-right">{{ $post->user->gender }}</div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="text-secondary text-left">Star</div>
                            <div class="text-right">200 <span class="far fa-star"></span></div>
                        </div>
                    </div>

                    @auth
                        @if(auth()->user()->id == $post->user->id)
                            <div class="card-footer">
                                
                                <div class="btn-toolbar justify-content-between" role="toolbar">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('posts-edit', $post->slug) }}" class="btn btn-success">Edit</a>
                                    </div>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal_delete">Delete</button>
                                    </div> 
                                </div>
                                
                            </div>
                        @endif
                    @endauth

                </div>
            </div>
            
        </div>
        
        <!-- Modal -->
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
@endsection