@extends('layouts.app')

@php
    use Carbon\Carbon;
   $date= 'd-m-Y H:i';
@endphp

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
                                <div>Author: {{$post->user->name}}</div>
                                <div>Creation date: {{$post->created_at->format($date)}}</div>
                                <div>Last edit: 
                                    @if($post->updated_at->diffInHours(Carbon::now()) <= 12)
                                    {{$post->updated_at->diffForHumans(Carbon::now())}}
                                    @else 
                                    {{$post->updated_at->format($date)}}
                                    @endif
                                </div>

                                @if ($post->category !== null)
                                <div>Category: <i>{{$post->category->genre}}</i></div>
                                @endif

                               
                                Tag:
                                @forelse ($post->tags as $tag )
                                <span class="badge bg-dark"> <i> -{{$tag->name}}- </i> </span>
                                @empty
                                <span><i> undefined </i></span>
                                @endforelse

                                
                            </li>
                            

                        
                            <div>
                            <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-secondary">Show Post</a>
                            <a href="{{ route('admin.posts.edit', $post->slug) }}" class="btn btn-info">Edit Post</a>
                            </div>
                        @endforeach
                        
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection