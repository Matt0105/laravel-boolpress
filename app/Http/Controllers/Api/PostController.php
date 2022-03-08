<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Post;
use App\Model\Category;
use App\User;

class PostController extends Controller
{
    public function index() 
    {
        $posts = Post::paginate(5);
        $users = User::all();
        $categories = Category::all();

        return response()->json([
            "response" => true,
            "resultsPosts" => $posts,
            "resultsUsers" => $users,
            "resultsCategories" => $categories,
        ]);
    }
}
