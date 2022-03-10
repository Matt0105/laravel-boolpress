<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Post;
use App\Model\Category;
use App\Model\Tag;
use App\User;

class PostController extends Controller
{
    public function index() 
    {
        $posts = Post::inRandomOrder()->limit(4)->get();
        $users = User::all();
        $categories = Category::all();
        $tags = Tag::with("posts")->get();

        return response()->json([
            "response" => true,
            "resultsPosts" => [
                "data" => $posts
            ],
            "resultsUsers" => $users,
            "resultsCategories" => $categories,
            "resultsTags" => $tags
        ]);
    }

    public function allPosts() {
        $posts = Post::paginate(5);
        $users = User::all();
        $categories = Category::all();
        $tags = Tag::with("posts")->get();

        return response()->json([
            "response" => true,
            "resultsPosts" => $posts,
            "resultsUsers" => $users,
            "resultsCategories" => $categories,
            "resultsTags" => $tags
        ]);
    }

    public function show($id) {
        $post = Post::find($id);
        $users = User::all();
        $categories = Category::all();
        $tags = Tag::with("posts")->get();

        return response()->json([
            "response" => true,
            "resultsPosts" => [
                "data" => $post
            ],
            "resultsUsers" => $users,
            "resultsCategories" => $categories,
            "resultsTags" => $tags
        ]);
    }

    public function filter(Request $request) {

        $data = $request->all();

        $posts = Post::where("id", ">=", 1);
        $users = User::all();
        $categories = Category::all();
        $tags = Tag::with("posts")->get();

        if(array_key_exists("orderCol", $data) && array_key_exists("orderVs", $data)) {
            $posts->orderBy($data["orderCol"], $data["orderVs"]);
        }

        return response()->json([
            "response" => true,
            "resultsPosts" => $posts->paginate(5),
            "resultsUsers" => $users,
            "resultsCategories" => $categories,
            "resultsTags" => $tags
        ]);
    }
}
