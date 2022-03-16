@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">Posts List
                    <a class="ms-auto" href="{{route('admin.posts.create')}}">New post</a>
                </div>
                

                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($postsList as $post)
                        <li class="list-group-item">
                            <h4>{{$post->title}}</h4>
                            <div>Autore: {{$post->user->name}}</div>
                            <div>Categoria: <i>{{$post->category->genre}}</i></div>
                        </li>
                       
                    
                        <div>
                        <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-secondary">Show Post</a>
                        <a href="{{ route('admin.posts.edit', $post->slug) }}" class="btn btn-info">Modify Post</a>
                        </div>
                        @endforeach
                        
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection