<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorListDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorListController extends Controller
{
    public function index(VendorListDataTable $dataTable)
    {

        return $dataTable->render("admin.vendor-list.index");
    }

    public function changeStatus(Request $request)
    {
        $category = User::findOrFail($request->id);
        $category->status = $request->status == "true" ? "active" : "inactive";
        $category->save();
        return response(['message' => 'Durum değiştirildi']);
    }
}
