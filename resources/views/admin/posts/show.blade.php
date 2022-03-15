@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header d-flex">
            {{ $post->title }}
          </div>

          <div class="card-body">

            {{ $post->content }}

            <div>{{$post->user->name}}</div>

            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Back</a>
            <form action="{{route('admin.posts.destroy', $post->slug)}}" method="post">
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