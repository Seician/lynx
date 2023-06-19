<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Repositories\CommentsRepository;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentRepository;

    public function __construct(CommentsRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return $this->commentRepository->getAllComments();

        $comment =  Comment::create([
            'post_id' => 1,
            'user_id' => 1,
            'body' => 'This is siler'
        ]);

        $comment->delete();


        dd("done");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show($id)
    {
        return $this->commentRepository->getCommentById($id);
    }

    public function showByParam(Request $request)
    {
        $search = $request->input('search');

        $comment = $this->commentRepository->searchParam($search);

        if ($comment) {
            return $comment;
        } else {
            return response()->json(['error' => 'Comment not found'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
