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
          <div class="card-header d-flex">
            <h3>{{ $post->title }}</h3>
          </div>

          <div class="card-body">
            {{-- <img src="{{$post->image}}" alt=""> --}}
            <div class="mb-3 fs-4">{{ $post->content }}</div>

            <div class="mb-3">{{$post->user->name}}</div>
            @if ($post->category !== null)
            <div class="text-secondary fs-6"><i> {{$post->category->genre}} </i></div>
            @endif

            <div class="text-secondary fs-6">
              <i>Creation date: {{$post->created_at->format($date)}} </i>
            </div>
            <div class="text-secondary fs-6">
              <i>Last edit: 
                @if($post->updated_at->diffInHours(Carbon::now()) <= 12)
                {{$post->updated_at->diffForHumans(Carbon::now())}}
                @else 
                {{$post->updated_at->format($date)}}
                @endif
              </i>
            </div>

            <div class="mb-3">
              @forelse ($post->tags as $tag )
              <span class="badge bg-secondary"> <i> -{{$tag->name}}- </i> </span>
              @empty
              <span><i> undefined </i></span>
              @endforelse
            </div>

            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Back</a>
            <form class="d-inline-block" action="{{route('admin.posts.destroy', $post->slug)}}" method="post">
                @csrf
                @method('delete')
              
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection