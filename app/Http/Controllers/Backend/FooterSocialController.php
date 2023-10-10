<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FooterSocialDataTable;
use App\Http\Controllers\Controller;
use App\Models\FooterSocial;
use Illuminate\Http\Request;

class FooterSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterSocialDataTable $dataTable)
    {
        return $dataTable->render('admin.footer.footer-socials.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.footer.footer-socials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|max:200',
            'name' => 'required|max:200',
            'link' => 'required|url',
            'status' => 'required',
        ]);

        $footer = new FooterSocial();
        $footer->icon = $request->icon;
        $footer->name = $request->name;
        $footer->link = $request->link;
        $footer->status = $request->status;
        $footer->save();
        toastr('Başarıyla kaydedildi', 'success', 'Başarılı');
        return redirect()->route('admin.footer-socials.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $footer = FooterSocial::findOrFail($id);
        return view('admin.footer.footer-socials.edit', compact('footer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon' => 'required|max:200',
            'name' => 'required|max:200',
            'link' => 'required|url',
            'status' => 'required',
        ]);

        $footer = FooterSocial::findOrFail($id);
        $footer->icon = $request->icon;
        $footer->name = $request->name;
        $footer->link = $request->link;
        $footer->status = $request->status;
        $footer->save();
        toastr('Başarıyla kaydedildi', 'success', 'Başarılı');
        return redirect()->route('admin.footer-socials.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footer = FooterSocial::findOrFail($id);
        $footer->delete();
        return response(['status' => 'success', 'message' => 'Silme işlemi başarılı']);
    }

    public function changeStatusSocial(Request $request){

        return response(['message' => $request->id]);
        $footer = FooterSocial::findOrFail($request->id);
        $footer->status = $request->status == "true" ? 1 : 0;
        $footer->save();
        return response(['message' => 'Durum değiştirildi']);

    }
}
