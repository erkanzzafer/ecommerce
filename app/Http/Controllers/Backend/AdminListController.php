<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminListDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class AdminListController extends Controller
{
    public function index(AdminListDataTable $dataTable)
    {

        return $dataTable->render("admin.admin-list.index");
    }

    public function changeStatus(Request $request)
    {
        $category = User::findOrFail($request->id);
        $category->status = $request->status == "true" ? "active" : "inactive";
        $category->save();
        return response(['message' => 'Durum değiştirildi']);
    }

    public function destroy($id)
    {
        //$admin= User::findOrFail($id)->delete();
        $admin = User::findOrFail($id);
        $products = Product::where('user_id', $id)->get();
        if (count($products) > 0) {
            return response(['status' => 'success', 'message' => 'Admine ait ürünler var silinemez']);
        }

        Vendor::where('user_id', $admin->id)->delete();
        $admin->delete();
        return response(['status' => 'success', 'message' => 'Silme işlemi başarılı']);
    }
}
