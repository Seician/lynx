<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    public function getLatestPost(string $searchTerm = null)
    {
        $query = Post::query();

        if ($searchTerm) {
            $query->filter($searchTerm);
        }

        return $query->with('author')
            ->orderBy('created_at', 'DESC')->first();
    }

    public function getAllPost()
    {
        return Post::all();
    }

    public function getPostWithDetails(Post $post)
    {
        return Post::where('id', $post->id)
            ->with('author')
            ->first();
    }
}
