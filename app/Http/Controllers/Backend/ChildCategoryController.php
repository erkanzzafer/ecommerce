<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.childcategory.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        return view('admin.childcategory.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category'      => 'required',
            'subcategory'   => 'required',
            'name'          => 'required|max:200|unique:child_categories,name',
            'status'        => 'required'
        ]);

        $childCategory = new ChildCategory();
        $childCategory->category_id=$request->category;
        $childCategory->sub_category_id=$request->subcategory;
        $childCategory->name=$request->name;
        $childCategory->slug=Str::slug($request->name);
        $childCategory->status=$request->status;

        $childCategory->save();
        toastr('Başarıyla kaydedildi','success');
        return redirect()->route('admin.childcategory.index');
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
        $categories=Category::all();
        $childCategory=ChildCategory::findOrFail($id);
        $subcategories=SubCategory::where('category_id', $childCategory->category_id)->get();
        return view('admin.childcategory.edit',compact('categories','childCategory','subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category'      => 'required',
            'subcategory'   => 'required',
            'name'          => 'required|max:200|unique:child_categories,name,'.$id,
            'status'        => 'required'
        ]);

        $childCategory = ChildCategory::findOrFail($id);
        $childCategory->category_id=$request->category;
        $childCategory->sub_category_id=$request->subcategory;
        $childCategory->name=$request->name;
        $childCategory->slug=Str::slug($request->name);
        $childCategory->status=$request->status;

        $childCategory->save();
        toastr('Başarıyla güncellendi','success');
        return redirect()->route('admin.childcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $childCategory=ChildCategory::findOrFail($id);
        $childCategory->delete();

        return response(['status'=> 'success','message'  => 'Başarıyla Silindi']);
    }

    public function getSubCategories (Request $request){
       $subcategories=SubCategory::where('category_id',$request->id)
       ->where('status',1)
       ->get();
       return $subcategories;
    }

    public function changeStatus(Request $request){
        $childCategory=ChildCategory::findOrFail($request->id);
        $childCategory->status=$request->status=='true' ? 1 : 0;
        $childCategory->save();

        return response(['status'=> 'success','message'  => 'Durum değiştirildi']);
    }

}
