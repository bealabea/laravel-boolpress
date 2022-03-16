@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">Add a new post</div>
                <div class="card-body">
                    <form action="{{ route('admin.posts.store') }}" method="post">
                        @csrf
          
                        <div class="mb-3">
                          <label>Title</label>
                          <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            placeholder="Insert title" value="{{ old('title') }}" required>
                          @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
          
                        <div class="mb-3">
                          <label>Content</label>
                          <textarea name="content" rows="10" class="form-control @error('content') is-invalid @enderror"
                            placeholder="What are you thinking about?" required>{{ old('content') }}</textarea>
                          @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>

                        <div class="mb-3">
                          <label>Categoria</label>
                          <select name="category_id" class="form-select">
                            <option value="">-- nessuna categoria --</option>
                            @foreach ($categories as $category)
                              <option value="{{ $category->id }}"
                                @if (old('category_id')=== $category->id) selected @endIf>
                                {{ $category->genre }}</option>
                            @endforeach
                          </select>
                        </div>
          
                        <div class="mb-3">
                          <label>Tags</label>
                            @foreach($tags as $tag)
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="checkbox" value="{{$tag->id}}" id="tag_{{$tag->id}}" name="tags[]">
                              <label class="form-check-label" for="tag_{{$tag->id}}">{{$tag->name}}</label>
                            </div>
                            @endforeach
                          </div>

                        <div class="form-group">
                          <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Back</a>
                          <button type="submit" class="btn btn-info">Save post</button>
                        </div>
                      </form>
                </div>
                        
@endsection