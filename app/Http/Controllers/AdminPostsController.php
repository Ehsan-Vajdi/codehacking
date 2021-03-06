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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index()
    {
        // get all posts from the user table
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
        // find the post if exists
        $post = Post::findOrFail($id);

        // get columns 'name' & 'id' in this order from category table to pass it throw to the edit page to show categories select box
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
        // put $request in a variable to make it easy to work with
        $input = $request->all();

        // find the post that is going to be updated
        $post = Post::findOrFail($id);

        // check if new file (photo) has been uploaded
        if ($file = $request->file('photo_id')){

            // if the user already has an image, then enter if statement
            if ($post->photo_id != null){
                // remove the old file (photo) from directory
                unlink(public_path() . '/' . $post->photo->file);

                // find the old file (photo) and remove from photo database
                Photo::findOrFail($post->photo->id)->delete();
            }

            // getting original file extension
            $ext = $file->getClientOriginalExtension();

            // creating new modified file name and assigning extension to it
            $fileName = time().'.'.$ext;

            // move file (photo) to directory
            $file->move('images/posts', $fileName);

            // add new photo name to photo database
            $photo = Photo::create(['file' => $fileName]);

            // add file id (photo id) to the post
            $input['photo_id'] = $photo->id;
        }

        // the next line updates the post for the user which is logged in:
        // Auth::user()->posts()->findOrFail($id)->first()->update($input);

        // adding user name whom updated the post to end of body
        $input['body'] = $input['body'] . "\n" . '(Updated By: ' . Auth::user()->name . ')';

        // if update process is a success/fail then send desired message
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
        // find the post to delete if exists
        $post = Post::findOrFail($id);
        // check if there is any image for post, if there is then remove it from directory and photo table
        if ($post->photo_id){
            unlink(public_path() . '/' . $post->photo->file);
            Photo::findOrFail($post->photo->id);
        }

        if ($post->delete())
            return redirect('admin/posts')->with('post_deleted', 'Post Deleted Successfully');
        return redirect('admin/posts')->with('post_not_deleted', 'Could not Delete the post!');

    }
}
