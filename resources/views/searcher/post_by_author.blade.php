@extends('layouts.app')

@section('title')
    Post by: {{ $user->username }}
@endsection

@section('content')
    <div class="container py-4">
        <h1>Post by : {{ $user->username }}</h1>
        <hr>
        <div class="row">
            @foreach ($posts as $post)
            <div class="col-6">
                <div class="card shadow mb-5">
                    <div class="card-header">{{ Str::limit($post->title, 66, '...') }}</div>
                    <div class="card-body">
                        <div class="mb-2">
                            {{ strip_tags(html_entity_decode(Str::limit( $post->body, 100, '...'))) }}
                        </div>
                        <a href="{{ route('posts-show', $post->slug) }}">Read More ...</a>
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
        
        <div class="d-flex justify-content-center">
            <div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection