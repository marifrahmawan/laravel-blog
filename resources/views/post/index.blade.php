@extends('layouts.app')

@section('title')
    Laravel Blog
@endsection


@section('content')


    <div class="container my-4">
        <div class="jumbotron">
            <div class="d-flex justify-content-between">
                <div>
                    <h4>All Post</h4>
                </div>
                <div>
                    @auth
                    <a href="{{ route('posts-create') }}" class="btn btn-sm btn-primary">Add Post</a>
                    @else
                    <a href="{{ url('login') }}" class="btn btn-sm btn-primary">Login to Add Post</a>
                    @endauth
                </div>
            </div>
            
            @include('includes.alert')
            
            <hr>
            @if ($posts->count())
            
                <div class="container-fluid">
                    <div class="row">
                        @foreach ($posts as $post)
                        <div class="col-6 d-flex">
                            <div class="card flex-fill shadow mb-5">
                                <div class="card-header">
                                    {{ Str::limit($post->title, 66, '...') }}
                                </div>
                                <div class="card-body">
                                    <div class="mb-2">
                                        {{ strip_tags(html_entity_decode(Str::limit($post->body, 100, '...'))) }}
                                    </div>
                                    <a href="{{ route('posts-show', $post->slug) }}">Read More</a>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            Published on {{ htmlspecialchars_decode($post->created_at->format('d F, Y')) }}
                                        </div>
                                        <div>
                                            Author <a href="{{ route('posts-find', $post->user->username) }}" class="badge badge-primary">{{ $post->user->username }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            @else
            
                <div class="col-12 alert alert-info text-center">
                    There are no post yet
                </div>
            
            @endif
            
            <div class="d-flex justify-content-center">
                <div>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection