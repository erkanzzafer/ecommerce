<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CustomerListDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerListController extends Controller
{
    public function index(CustomerListDataTable $dataTable)
    {

        return $dataTable->render("admin.customer-list.index");
    }

    public function changeStatus(Request $request)
    {
        $category = User::findOrFail($request->id);
        $category->status = $request->status == "true" ? "active" : "inactive";
        $category->save();
        return response(['message' => 'Durum değiştirildi']);
    }
}
