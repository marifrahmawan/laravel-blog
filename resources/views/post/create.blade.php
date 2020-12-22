@extends('layouts.app')

@section('title')
    Create Post    
@endsection


@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">New Post</div>
                    <div class="card-body">
                        <form action="{{route('posts-store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form group">
                                <label for="Title">Title</label>
                                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" autocomplete="off" >
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="thumbnail">Thumbnail</label>
                                <input type="file" name="thumbnail" id="thumbnail" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label for="category" class="mb-2 mt-3">Category</label>
                                <select name="category_id[]" class="form-control select2-category @error('category_id') is-invalid @enderror" multiple>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
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
                                <textarea type="text" name="body" id="content" class="form-control @error('body') is-invalid @enderror" rows="30" autocomplete="off">{{ old('body') }}</textarea>

                                @error('body')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <br>
                            <button type="submit" class="btn btn-sm btn-primary">Create</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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