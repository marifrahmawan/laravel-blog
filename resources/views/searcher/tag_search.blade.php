@extends('layouts.app')

@section('title')
    Tag: {{ $tag->name }}
@endsection

@section('content')
    <div class="container py-4">
        <h1>Tag : {{ $tag->name }}</h1>
        <hr>
        <div class="row">
            @foreach ($items as $item)
            <div class="col-6">
                <div class="card shadow mb-5">
                    <div class="card-header">{{ Str::limit($item->title, 66, '...') }}</div>
                    <div class="card-body">
                        <div class="mb-2">
                            {{ strip_tags(html_entity_decode(Str::limit( $item->body, 100, '...'))) }}
                        </div>
                        <a href="{{ route('posts-show', $item->slug) }}">Read More ...</a>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <div>
                                Published on {{ htmlspecialchars_decode($item->created_at->format('d F, Y')) }}
                            </div>
                            <div>
                                Author <a href="{{ route('posts-find', $item->user->username) }}" class="badge badge-primary">{{ $item->user->username }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="d-flex justify-content-center">
            <div>
                {{ $items->links() }}
            </div>
        </div>
    </div>
@endsection