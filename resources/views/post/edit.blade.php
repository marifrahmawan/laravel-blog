@extends('layouts.app')

@section('title')
    Edit Post {{ $post->title }}   
@endsection


@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Edit Post</div>
                    <div class="card-body">
                        <form action="{{route('posts-update', $post->slug)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form group">
                                <label for="Title">Title</label>
                                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') ?? $post->title}}" autocomplete="off" >
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <label for="Current Image">Current Thumbnail</label>
                                <div class=>
                                    <img src="{{ Storage::url($post->thumbnail) }}" width="300 px" class="img-fluid rounded">
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label for="thumbnail">Thumbnail</label><br>
                                <input type="file" name="thumbnail" id="thumbnail" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label for="category" class="mb-2 mt-3">Category</label>
                                <select name="category_id[]" class="form-control select2-category @error('category_id') is-invalid @enderror" multiple>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" 
                                            @foreach ($post->categories as $category_selected)
                                                {{ $category_selected->id == $category->id ? 'selected' : '' }} 
                                            @endforeach
                                        >
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tag" class="mb-2 mt-3">Tag</label>
                                <select name="tag_id[]" class="form-control select2-tag @error('tag_id') is-invalid @enderror" multiple>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                            @foreach ($post->tags as $tag_selected)
                                                {{ $tag_selected->id == $tag->id ? 'selected' : ''}}
                                            @endforeach
                                        >
                                            {{ $tag->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tag_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form group">
                                <label for="Body">Body</label>
                                <textarea type="text" name="body" id="content" class="form-control @error('body') is-invalid @enderror" rows="20">{{ old('body') ?? $post->body }}</textarea>

                                @error('body')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <br>
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('addon-style')
    <style>
        .select2 {
            width:100%!important;
        }
    </style>
@endpush

@push('addon-script')
<script src="{{ url('ckeditor/ckeditor.js') }}"></script>
<script>
    var content = document.getElementById("content");
    CKEDITOR.replace(content,{
        height: 500,
        language:'en-gb'
    });
    CKEDITOR.config.allowedContent = true;
</script>
<script>
    $(document).ready(function() {
        $('.select2-category').select2({
            placeholder: "Select Category"
        });

        $('.select2-tag').select2({
            placeholder: "Select Tag"
        });
    });
</script>
@endpush