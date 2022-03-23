<?php

namespace App\Http\Controllers\Admin;
use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\Traits\SlugGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    use SlugGenerator;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postsList = Post::all();
        return view('admin.posts.index', compact('postsList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                "title" => "required|min:5",
                "content" => "required|min:10",
                "category_id" => "nullable",
                'tags' => "nullable",
                'image' => "nullable|max:10000"
            ]
        );
        $post = new Post();
        
        $post->fill($data);
        
        $post->slug=$this->generateUniqueSlug($post->title);
        
        $post->user_id = Auth::user()->id;

        if(key_exists('image', $data)) {
            $post->image = Storage::put('postImages', $data['image']);
        }
        $post->save();

        if (key_exists("tags", $data)) {     
        $post->tags()->attach($data["tags"]);
        }

        return redirect()->route("admin.posts.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where("slug", $slug)->firstOrFail();

        return view("admin.posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where("slug", $slug)->firstOrFail();
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $data = $request->validate(
            [
                "title" => "required|min:5",
                "content" => "required|min:10",
                "category_id" => "nullable",
                'tags' => "nullable|exists:tags,id",
                'image' => "nullable|max:10000"
            ]
        );

        $post = Post::where("slug", $slug)->firstOrFail();

        if ($data["title"] !== $post->title) {
            $data["slug"] = $this->generateUniqueSlug($data["title"]);
        }

        $post->update($data);

        if(key_exists('image', $data)) {
            if($post->image){
                Storage::delete($post->image);  
            }
            $post->image = Storage::put('postImages', $data['image']);
            $post->save();
        }

        if (key_exists("tags", $data)) {   
            $post->tags()->sync($data["tags"]);
        } else {
            $post->tags()->detach(); 
        }
          // aggiorno tabella ponte post_tag invocando la funzione tags (è la funzione belongstoMany su post)
        // rimuovo dal post corrente tutte le relazioni esistenti con i tag
        // $post->tags()->detach();
        // aggiungo al post corrente le relazioni con i tag ricevuti
        // $post->tags()->attach($data['tags']);

        // il sync fa prima il detach(se necessario) e poi l'attach(se necessario) 


        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::where("slug", $slug)->firstOrFail();

        $post->tags()->detach();

        if($post->image){
            Storage::delete($post->image);  
        }
        
        $post->delete();

        return redirect()->route('admin.posts.index');
    }

}


