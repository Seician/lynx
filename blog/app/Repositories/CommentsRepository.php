<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentsRepository
{
    public function getAllComments()
    {
        return Comment::all();
    }

    public function getCommentById($id)
    {
        return Comment::with('post')->find($id);
    }

    public function searchParam($search)
    {
        return Comment::with('post')->where('body', 'like', '%'.$search.'%')->first();
    }
}
