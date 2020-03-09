<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Comment::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCommentRequest $request)
    {
        $comment = Comment::create($request->all());

        return response()->json('Comment created successfully!', 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCommentRequest $request, Comment $comment)
    {
        $comment->update($request->all());

        return response()->json([
            'message' => 'Comment updated successfully!',
            'data' => $comment,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if ($comment->user_id != auth()->user()->id) {
            return response()->json('Unauthorized', 401);
        }

        $comment->delete();

        return response()->json('Comment deleted!', 200);
    }
}
