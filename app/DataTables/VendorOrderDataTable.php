<?php

namespace App\DataTables;

use App\Models\Order;
use App\Models\VendorOrder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class VendorOrderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $editBtn = "<a href='" . route('vendor.orders.show', $query->id) . "' class='btn btn-primary'><i class='far fa-eye'></i></a>";
                return $editBtn;
            })
            ->addColumn('customer', function ($query) {
                return $query->user->name;
            })
            ->addColumn('amount', function ($query) {
                return $query->currency_icon . $query->amount;
            })
            ->addColumn('created_at', function ($query) {
              return $query->created_at->isoFormat('D MMMM YYYY');
            })
            ->addColumn('order_status', function ($query) {
                switch ($query->order_status) {
                    case 'pending':
                        return   "<span class='badge bg-warning'>Pending</span>";;
                        break;
                    case 'processed_and_ready_to_ship':
                        return   "<span class='badge bg-info'>Processed</span>";;
                        break;
                    case 'dropped_off':
                        return   "<span class='badge bg-info'>dropped_off</span>";;
                        break;
                    case 'shipped':
                        return   "<span class='badge bg-info'>Shipped</span>";;
                        break;
                    case 'out_for_delivery':
                        return   "<span class='badge bg-primary'>Out For Delivery</span>";;
                        break;
                    case 'delivered':
                        return   "<span class='badge bg-success'>Delivered</span>";;
                        break;
                    case 'cancelled':
                        return   "<span class='badge bg-danger'>Cancelled</span>";;
                        break;

                    default:
                        break;
                }
            })
            ->addColumn('payment_status', function ($query) {
                if ($query->payment_status == 1) {
                    return "<span class='badge bg-success'>Gerçekleşti</span>";
                } else {
                    return "<span class='badge bg-warning'>Gerçekleşmedi</span>";
                }
            })
            ->rawColumns(['order_status', 'action', 'payment_status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        return $model->newQuery();
       /* return $model::whereHas('orderProducts',function($query){
            $query->where('vendor_id' , Auth::user()->vendor->id);
        })->newQuery();*/
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendororder-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('invocie_id')->title('Fatura ID'),
            Column::make('customer')->title('Müşteri Adı'),
            Column::make('created_at')->title('Tarih'),
            Column::make('product_qty'),
            Column::make('amount')->title('Fiyat'),
            Column::make('order_status'),
            Column::make('payment_status')->title('Ödeme'),
            Column::make('payment_method'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorOrder_' . date('YmdHis');
    }
}
