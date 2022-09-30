<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        $categories = Category::select('id', 'label')->orderBy('id')->get();
        $tags = Tag::select('id', 'label')->orderBy('id')->get();
        return view('admin.posts.create', compact('post', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $post = new Post();

        $data['slug'] = Str::slug($request->title, '-');

        $post->fill($data);

        $post->user_id = Auth::id();

        $post->save();

        return redirect()->route('admin.posts.show', $post)
            ->with('message', "Post creato con successo")
            ->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if($post->user_id !== Auth::id()) {
            return redirect()->route('admin.posts.index')
                    ->with('message', "Non sei autorizzato a modificare questo post creato da {$post->author->name}")
                    ->with('type', 'warning');
        }

        $categories = Category::select('id', 'label')->orderBy('id')->get();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($data['title'], '-');

        $post->update($data);

        return redirect()->route('admin.posts.show', $post)
            ->with('message', "Post modificato con successo")
            ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->user_id !== Auth::id()) {
            return redirect()->route('admin.posts.index')
                    ->with('message', "Non sei autorizzato a cancellare questo post creato da {$post->author->name}")
                    ->with('type', 'warning');
        }

        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('message', "Il post è stato eliminato con successo")
            ->with('type', 'success');
    }
}
