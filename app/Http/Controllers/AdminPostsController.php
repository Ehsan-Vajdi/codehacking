<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostCreateRequest;
use App\Photo;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        //dd(Post::pluck('photo_id')->all());
        $photos = Post::pluck('photo_id')->all() + integer(User::pluck('photo_id')->all());
        dd($photos);
        //

        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //
        $categories = Category::pluck('name', 'id')->all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(PostCreateRequest $request)
    {
        //
        $input = $request->all();

        if ($file = $request->file('photo_id')){

            // getting original file extension
            $ext = $file->getClientOriginalExtension();

            // creating new file name and assigning extension to it
            $fileName = time().'.'.$ext;

            $file->move('images/posts', $fileName);

            $photo = Photo::create(['file' => $fileName]);

            $input['photo_id'] = $photo->id;
        }

        $user = Auth::user();
        if ($user->posts()->create($input))
            return redirect('/admin/posts')->with('post_created', 'New Post Created');
        return redirect('/admin/posts')->with('post_not_created', 'Could not Creat Post!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        //
        return view('admin.posts.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        //

        $post = Post::findOrFail($id);

        $categories = Category::pluck('name', 'id')->all();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(PostCreateRequest $request, $id)
    {
        //

        $input = $request->all();

        if ($file = $request->file('photo_id')){

            // getting original file extension
            $ext = $file->getClientOriginalExtension();

            // creating new file name and assigning extension to it
            $fileName = time().'.'.$ext;

            $file->move('images/posts', $fileName);

            $photo = Photo::create(['file' => $fileName]);

            $input['photo_id'] = $photo->id;

        }

        // if you want to change post original owner to the one whoe updated it:
        // Auth::user()->posts()->findOrFail($id)->first()->update($input);

        // adding user name whom updated the post to end of body
        $input['body'] = $input['body'] . "\n" . '(Updated By: ' . Auth::user()->name . ')';

        $post = Post::findOrFail($id);

        if ($post->update($input))
            return redirect('/admin/posts')->with('update_post', 'Post Updated Successfully');
        return redirect('/admin/posts')->with('not_able_update_post', 'Could not Update the Post!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        //

        $post = Post::findOrFail($id);

        if ($post->photo_id){
            unlink(public_path() . '/' . $post->photo->file);
        }

        if ($post->delete())
            return redirect('admin/posts')->with('post_deleted', 'Post Deleted Successfully');
        return redirect('admin/posts')->with('post_not_deleted', 'Could not Delete the post!');

    }
}
