<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FooterGridThreeDataTable;
use App\DataTables\FooterGridTwoDataTable;
use App\Http\Controllers\Controller;
use App\Models\FooterGridThree;
use App\Models\FooterGridTwo;
use App\Models\FooterTitle;
use Illuminate\Http\Request;

class FooterGridThreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterGridThreeDataTable $datatable)
    {
        $footerTitle = FooterTitle::first();
        return $datatable->render('admin.footer.footer-grid-three.index',compact('footerTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.footer.footer-grid-three.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:200',
            'link' => 'required|url',
            'status' => 'required'
        ]);

        $footer = new FooterGridThree();
        $footer->name = $request->name;
        $footer->url = $request->link;
        $footer->status = $request->status;
        $footer->save();
        toastr('success', 'Başarıyla kaydedildi', 'Başarılı');
        return redirect()->route('admin.footer-grid-three.index');
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
        $footer = FooterGridThree::findOrFail($id);
        return view('admin.footer.footer-grid-three.edit', compact('footer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:200',
            'link' => 'required|url',
            'status' => 'required'
        ]);

        $footer = FooterGridThree::findOrFail($id);
        $footer->name = $request->name;
        $footer->url = $request->link;
        $footer->status = $request->status;
        $footer->save();
        toastr('success', 'Başarıyla Güncellendi', 'Başarılı');
        return redirect()->route('admin.footer-grid-three.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footer = FooterGridThree::findOrFail($id);
        $footer->delete();
        return response(['status' => 'success', 'message' => 'Silme işlemi başarılı']);
    }

    public function changeStatusGrid(Request $request)
    {
        $footer = FooterGridThree::findOrFail($request->id);
        $footer->status = $request->status == "true" ? 1 : 0;
        $footer->save();
        return response(['message' => 'Durum başarıyla güncellendi']);
    }

    public function changeTitle(Request $request)
    {
        $request->validate([
            'title' => 'required|max:200',
        ]);

        FooterTitle::updateOrCreate(
            ['id' => 1],
            [
                'footer_grid_three_title' => $request->title
            ]
        );

        toastr('Güncelleme başarılı', 'success', 'Başarılı');
        return redirect()->back();
    }
}
