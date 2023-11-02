<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Terms;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index()
    {
        $term = Terms::first();
        return view("admin.terms.index", ['term' => $term]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        Terms::updateOrCreate(
            [
                'id' => 1,
            ],
            [
                'content' => $request->content
            ]
        );

        toastr('Güncelleme Başarılı', 'success', 'Başarılı');
        return redirect()->back();
    }
}
