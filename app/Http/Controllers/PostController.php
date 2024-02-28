<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['posts'] = Post::orderBy('id', 'desc')->paginate(5);

        return view('posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $posts = new Post;
        $posts->user_id = Auth::user()->id;
        $posts->title = $request->title;
        $posts->content = $request->content;
        $posts->save();

        return redirect()->route('post')
            ->with('success','The post has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Posts $post
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Posts $post
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->update();

        return redirect()->route('post')
            ->with('success','The post Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Posts $post
     * @return RedirectResponse
     */
    public function destroy(Post $post)
    {
        Comment::where('post_id', $post->id)
            ->delete();
        $post->delete();

        return redirect()->route('post')
            ->with('success','The post has been deleted successfully');
    }
}
