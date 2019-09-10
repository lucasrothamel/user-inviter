<?php

namespace App\Http\Controllers;

use App\Http\Request\PostStoreRequest;
use App\Models\Posts;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Show the form to create a post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('posts.create.index');
    }

    /**
     * Save a new post to the database
     * @param PostStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(PostStoreRequest $request)
    {
        $post = new Posts();
        $post->user_id = auth()->user()->id;
        $post->description = $request->description;

        if ($request->file('image')) {
            $this->handleImagePost($request, $post);
        } else {
            $this->handleTextPost($post);
        }

        $post->save();

        return redirect('/users/' . auth()->user()->id);
    }

    /**
     * @param PostStoreRequest $request
     * @param Posts $post
     */
    private function handleImagePost(PostStoreRequest $request, Posts $post): void
    {
        $path = Storage::putFile('public/posts', $request->file('image'));
        $filename = basename($path);

        $post->image_url = getenv('APP_URL') . "/" . "storage/posts/" . $filename;
        $post->type = "image";
        $post->filename = $request->file('image')->getClientOriginalName();
    }

    /**
     * @param Posts $post
     */
    private function handleTextPost(Posts $post): void
    {
        $post->type = "text";
    }
}
