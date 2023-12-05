<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }


    public function store(StoreCommentRequest $request)
    {
        //  dd($request->id);
        // dd($request);

        $validated = $request->validated();


        //    $comments= Comment::create([
        //         // 'comment_content' => $validated['comment_content'],
        //         'comment_content' => $request->comment_content,
        //         'post_id' => $request->id,
        //         'user_id' => auth()->user()->id,
        //     ]);


        $comments = auth()->user()->comments()->create(
            [
                'comment_content' =>  $validated['comment_content'],
                'post_id' => $request->id,
                'user_id' => auth()->user()->id,
            ]
        );
        return redirect('dashboard')->with('success', "commented successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
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
    public function update(UpdateCommentRequest $request, Comment $comment)
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
