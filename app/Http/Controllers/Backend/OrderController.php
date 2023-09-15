<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\canceledOrderDataTable;
use App\DataTables\deliveredOrderDataTable;
use App\DataTables\droppedOffOrderDataTable;
use App\DataTables\OrderDataTable;
use App\DataTables\outForDeliveryOrderDataTable;
use App\DataTables\PendingOrderDataTable;
use App\DataTables\processedOrderDataTable;
use App\DataTables\shippedOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.index');
    }

    public function pendingOrders(PendingOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.pending-order');
    }

    public function processedOrders(processedOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.processed-order');
    }
    public function droppedOffOrders(droppedOffOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.droppedOff-order');
    }

    public function shippedOrders(shippedOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.shipped-order');
    }

    public function outForDeliveryOrders(outForDeliveryOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.outForDelivery-order');
    }

    public function deliveredOrders(deliveredOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.delivered-order');
    }



    public function cancelledOrders(canceledOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.canceled-order');
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $order = Order::findOrFail($id);
        if ($order->orderProducts) {
            $order->orderProducts()->delete();
        }
        if ($order->transaction) {
            $order->transaction()->delete();
        }
        $order->delete();



        
        return response(['status' => 'success', 'message' => 'Silme işlemi başarılı!']);

    }


    public function changeOrderStatus(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->order_status = $request->status;
        $order->save();
        return response(['status' => 'success', 'message' => 'Sipariş durumu güncellendi']);
    }

    public function changePaymentStatus(Request $request)
    {
        $payment = Order::findOrFail($request->id);
        $payment->payment_status = $request->status;
        $payment->save();
        return response(['status' => 'success', 'message' => 'Ödeme durumu güncellendi']);
    }
}
