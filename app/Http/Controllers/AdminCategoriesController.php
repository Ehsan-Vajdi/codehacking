<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryCreateRequest;
use Illuminate\Http\Request;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CategoryCreateRequest $request)
    {
        // check if category created
        if (Category::create($request->all()))
            return redirect('/admin/categories')->with('category_created', 'Category created successfully.');
        return redirect('/admin/categories')->with('category_not_created', 'Failed to create new category!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CategoryCreateRequest $request, $id)
    {
        //
        if (Category::findOrFail($id)->update($request->all()))
            return redirect('/admin/categories')->with('category_updated', 'Category updated successfully.');
        return redirect('/admin/categories')->with('category_not_updated', 'Could not update category!.');
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
        if (Category::findOrFail($id)->delete())
            return redirect('/admin/categories')->with('category_deleted', 'Category deleted successfully.');
        return redirect('/admin/categories')->with('category_not_deleted', 'Could not deleted Category.');
    }
}
