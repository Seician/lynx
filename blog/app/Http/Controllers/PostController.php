<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Repositories\CategoryRepository;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postRepository;

    protected $categoryRepository;

    public function __construct(PostRepository $postRepo, CategoryRepository $categoryRepo)
    {
        $this->postRepository = $postRepo;
        $this->categoryRepository = $categoryRepo;
    }

    public function index(Request $request)
    {
        $latest_post = $this->postRepository->getLatestPost($request->get('search', null));
        $posts = $this->postRepository->getAllPost();
        $categories = $this->categoryRepository->getAllCategories();

        return view('posts', [
            'posts' => $posts,
            'latest_post' => $latest_post,
            'categories' => $categories,
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
