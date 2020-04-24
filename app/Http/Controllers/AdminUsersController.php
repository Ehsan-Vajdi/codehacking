<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //

        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        // pulling specific data from role table with 'pluck' method and bring it down with 'all' method
        // note: pay attention to the column order, because you may use key=>value on the other side
        $roles = Role::pluck('name', 'id')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(UsersRequest $request)
    {
        //
        $input = $request->all();

        if ($file = $request->file('photo_id')){

            // getting original file extension
            $ext = $file->getClientOriginalExtension();

            // creating new file name and assigning extension to it
            $fileName = time().'.'.$ext;

            /*
            resizing image
            */
            $image_resize = Image::make($file->getRealPath());
            $image_resize->resize(400, 400);
            //$file->move('images/users', $name);
            // previous line replaced with next line
            $image_resize->save(public_path('images/users/' . $fileName));
            /*
            end of image resize
            */

            $photo = Photo::create(['file' => $fileName]);

            $input['photo_id'] = $photo->id;

        }

        // hashing password
        $input['password'] = bcrypt($request->password);

        if (User::create($input))
            return redirect('/admin/users')->with('user_created', 'New User Created');
        return redirect('/admin/users')->with('user_not_created', 'Could not Creat User!');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);

        $roles = Role::pluck('name', 'id')->all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UsersEditRequest $request, $id)
    {
        // check if user has filled password
        // trim method is used to avoid white space
        if (trim($request->password) == '')
            $input = $request->except('password');
        else{
            $input = $request->all();
            // hashing password
            $input['password'] = bcrypt($request->password);
        }

        if ($file = $request->file('photo_id')){

            // getting original file extension
            $ext = $file->getClientOriginalExtension();

            // creating new file name and assigning extension to it
            $fileName = time().'.'.$ext;

            /*
            resizing image
            */
            $image_resize = Image::make($file->getRealPath());
            $image_resize->resize(400, 400);
            //$file->move('images/users', $name);
            // previous line replaced with next line
            $image_resize->save(public_path('images/users/' . $fileName));
            /*
            end of image resize
            */

            $photo = Photo::create(['file' => $fileName]);

            $input['photo_id'] = $photo->id;

        }

        $user = User::findOrFail($id);

        if ($user->update($input))
            return redirect('/admin/users')->with('update_user', 'User Updated Successfully');
        return redirect('/admin/users')->with('not_able_update_user', 'Could not Update the User!');

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
        $user = User::findOrFail($id);

        // remove user photo from image.users
//        if ($user->photo_id){
//            $image_path = $user->photo->file;
//            if(File::exists($image_path)) {
//                File::delete($image_path);
//            }
//        }
        // or
        if ($user->photo_id){

            unlink(public_path() . '/' . $user->photo->file);

        }

        // delete user and redirect to users page, sent a delete status message as well
        if ($user->delete())
            return redirect('admin/users')->with('user_deleted', 'User Deleted Successfully');
        return redirect('admin/users')->with('user_not_deleted', 'Could not Delete the User!');
    }
}
