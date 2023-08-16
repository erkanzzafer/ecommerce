<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use League\CommonMark\Extension\InlinesOnly\ChildRenderer;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.subcategory.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'name'     =>  'required|max:200|unique:sub_categories,name',
            'status'   => 'required'
        ], [
            'category.required' => 'Kategori alanını doldurun',
            'name.required' => 'İsim alanını doldurun',
        ]);

        $subCategory = new SubCategory();
        $subCategory->category_id = $request->category;
        $subCategory->name = $request->name;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->status = $request->status;
        $subCategory->save();
        toastr('Alt kategori başarıyla eklendi', 'success');
        return redirect()->route('admin.subcategory.index');
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
        $categories = Category::all();
        $subcategory = SubCategory::findOrFail($id);
        return view('admin.subcategory.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category' => 'required',
            'name'     => 'required|max:200|unique:sub_categories,name,' . $id,
            'status'   => 'required'
        ], [
            'category.required' => 'Kategori alanını doldurun',
            'name.required' => 'İsim alanını doldurun',
        ]);

        $subCategory = SubCategory::findOrFail($id);
        $subCategory->category_id = $request->category;
        $subCategory->name = $request->name;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->status = $request->status;
        $subCategory->save();
        toastr('Alt kategori başarıyla güncellendi', 'success');
        return redirect()->route('admin.subcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $childCategory=ChildCategory::where('subcategory_id',$subcategory->id)->count();
        if($childCategory>0){
            return response(['status'=>'error','message'=>'Çocuk kategorileri olduğu için silinemedi']);
        }
        $subcategory->delete();

        return response(['status' => 'success', 'message'  => 'Başarıyla Silindi']);
    }
    public function changeStatus(Request $request)
    {
        $subcategory = SubCategory::findOrFail($request->id);
        $subcategory->status = $request->status == "true" ? 1 : 0;
        $subcategory->save();
        return response(['message' => 'Durum değiştirildi']);
    }
}
