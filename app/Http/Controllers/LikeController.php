<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LikeController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'post_id' => [
                'required',
                'exists:posts,id',
                Rule::unique('likes', 'post_id')->where('user_id', auth()->user()->id),
            ]
        ]);
        $post = Post::findOrFail($request->post_id);
        $existingLike = Like::where('post_id', $post->id)
            ->where('user_id', auth()->user()->id)
            ->first();
        if ($existingLike) {
            return redirect()->back()->with('error', 'You have already liked this post.');
        }
        $post->loadCount('likes');
        $likesCount = $post->likes_count;
        Like::create([
            'post_id' =>  $request->post_id,
            'user_id' => auth()->user()->id
        ]);
        return redirect()->back()->with('success', 'Post liked successfully.');
    }
}
