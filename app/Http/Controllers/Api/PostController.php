<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use App\Traits\SlugGenerator;
use Illuminate\Http\Request;

class PostController extends Controller {
  use SlugGenerator;

  public function index() {
    $posts = Post::all();
    $posts->load('user', 'category', 'tags');

    /* return response()->json([
      "esito" => "ok",
      "dataRichiesta" => now(),
      "data" => $posts
    ]); */

    $posts->each(function ($post){
      if (str_starts_with($post->image, 'https')){
          return $post->image;
      } else if($post->image){
        $post->image = asset('storage/' . $post->image);
      } else {
        $post->image = "https://www.logistec.com/wp-content/uploads/2017/12/placeholder.png";
      }
    });
    
    return response()->json($posts);
  }

  public function store(Request $request) {
    $data = $request->validate([
        "title" => "required|min:5",
        "content" => "required|min:10",
        "category_id" => "nullable",
        'tags' => "nullable",
        'image' => "nullable"
    ]);

    $newPost = new Post();
    $newPost->fill($data);
    $newPost->user_id = 1;
    $newPost->slug = $this->generateUniqueSlug($data["title"]);
    $newPost->save();

    if(key_exists("tags", $data)){
      $newPost->tags()->attach($data["tags"]);
    }

    return response()->json($newPost);
  }

  public function show($slug) {
    $post = Post::where("slug", $slug)
      ->with(["tags", "user", "category"])
      ->firstOrFail();

      if (str_starts_with($post->image, 'https')){
        return $post->image;
    } else if($post->image){
      $post->image = asset('storage/' . $post->image);
    } else {
      $post->image = "https://www.logistec.com/wp-content/uploads/2017/12/placeholder.png";
    };

    if (!$post) {
      abort(404);
    }

    return response()->json($post);
  }
}
