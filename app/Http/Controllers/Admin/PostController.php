<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy("updated_at", "desc")->paginate(10);

        return view('admin.posts.index', compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.posts.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            "title" => "required|max:255",
            "content" => "required"
        ]);

        $newPost = new Post();

        $data = $request->all();

        $slug = Str::slug($data["title"], '-');
        $ifSlugThereIs = Post::where("slug", $slug)->first();

        $slugCounter = 0;
        while($ifSlugThereIs) {
            $slug = $slug . '-' . $slugCounter;
            $ifSlugThereIs = Post::where("slug", $slug)->first();
            $slugCounter++;
        }

        $newPost->title = $data["title"];
        $newPost->content = $data["content"];
        $newPost->slug = $slug;
        $newPost->user_id = Auth::user()->id;

        $newPost->save();

        return redirect()->route("admin.posts.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("admin.posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view("admin.posts.edit", compact("post"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validation = $request->validate([
            "title" => "required|max:255",
            "content" => "required"
        ]);

        $data = $request->all();

        $slug = Str::slug($data["title"], '-');
        $ifSlugThereIs = Post::where("slug", $slug)->first();

        $slugCounter = 0;
        while($ifSlugThereIs) {
            $slug = $slug . '-' . $slugCounter;
            $ifSlugThereIs = Post::where("slug", $slug)->first();
            $slugCounter++;
        }

        $post->title = $data["title"];
        $post->content = $data["content"];
        $post->slug = $slug;

        $post->save();

        return redirect()->route("admin.posts.index", compact("post"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with("status", "Post '$post->title' deleted");
    }

    public function filter() {

        $posts = Post::orderBy("updated_at", "desc")->where("user_id", Auth::user()->id)->paginate(10);

        return view('admin.posts.myPosts', compact("posts"));
    }
}
