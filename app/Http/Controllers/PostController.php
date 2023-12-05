<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->withCount('comments', 'likes')->get();
        return view('dashboard', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('post_image')) {
            $imageName = time() . '.' . $request->post_image->extension();
            $request->post_image->storeAs('public/images', $imageName);
        }
        $posts = auth()->user()->posts()->create([
            'post_content' =>
            $validated['post_content'],
            'post_image' => $imageName ?? null,
        ]);
        return redirect()->route('dashboard')->with('success', "created post successfully");
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // dd($post->id);
        if (!Session::has('viewed_posts.' . $post->id)) {
            $post->increment('views_count');
            Session::put('viewed_posts.' . $post->id, true);
        }
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Post $post)
    // {
    //     // dd($post);
    //     $post->delete();
    //     return redirect()->route('dashboard')->with('success', "deleted post successfully");
    // }
    //     public static function UnlinkImage($filepath, $fileName)
    //     {
    //         $old_image = $filepath . $fileName;
    //         if (file_exists($old_image)) {
    //             @unlink($old_image);
    //         }
    //     }
    //     $image_path = "the name of your image path here/".$request->Image;
    //  $image_path         = public_path("\storage\images\\") .$post->post_image;

    //  if (file_exists($image_path)) {

    //        @unlink($image_path);

    //    }
    public function destroy($id)
    {
        $post             = Post::findOrFail($id);
        $image_path         = public_path("\storage\images\\") . $post->post_image;

        if (File::exists($image_path)) {
            File::delete($image_path);
        } else {
            $post->delete();
            //abort(404);
        }

        $post->delete();

        return redirect()->route('dashboard')->with('success', "deleted post successfully");
    }
}
