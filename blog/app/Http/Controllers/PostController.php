<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepository = $postRepo;
    }

    public function index(Request $request)
    {
        $latest_post = $this->postRepository->getLatestPost($request->get('search', null));
        $posts = $this->postRepository->getAllPost();

        return view('posts', [
            'posts' => $posts,
            'latest_post' => $latest_post,
            'categories' => Category::all(),
        ]);
    }

    public function show(Post $post)
    {
        $post = $this->postRepository->getPostWithDetails($post);

        return view('post', [
            'post' => $post,
        ]);
    }
}
