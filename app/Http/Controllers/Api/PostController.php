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

    return response()->json($posts);
  }

  public function store(Request $request) {
    $data = $request->validate([
        "title" => "required|min:5",
        "content" => "required|min:10",
        "category_id" => "nullable",
        'tags' => "nullable"
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

  public function show($id){
    $post = Post::where("id", $id)->with(["tags", "user", "category"])->first();
    // $post = Post::where("id", $id)->first();

    return response()->json($post);
  }
}
