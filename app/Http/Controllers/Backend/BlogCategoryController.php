<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BlogCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BlogCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.blog.blog-categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.blog.blog-categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:200|unique:blog_categories',
        ]);
        $category = new BlogCategory();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;
        $category->save();
        toastr('Kategori başarıyla eklendi', 'success');
        return redirect()->route("admin.blog.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blogCategory = BlogCategory::findOrFail($id);
        return view("admin.blog.blog-categories.edit", compact("blogCategory"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:200|unique:blog_categories,id,' . $id,
        ]);
        $category = BlogCategory::findOrFail($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;
        $category->save();
        toastr('Kategori başarıyla güncellendi', 'success');
        return redirect()->route("admin.blog.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blogCat = BlogCategory::findOrFail($id);
        $blogCat->delete();
        return response(['status' => 'success', 'message' => 'Silme başarılı']);
    }

    public function changeStatus(Request $request)
    {
        $blogCat = BlogCategory::findOrFail($request->id);
        $blogCat->status = $request->status == 'true' ? 1 : 0;
        $blogCat->save();
        return response(['message' => 'Durum güncellendi']);
    }
}
