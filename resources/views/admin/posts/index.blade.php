@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lista dei post</div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($postsList as $post)
                        <li class="list-group-item">{{$post->title}}</li> 
                        @endforeach
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection