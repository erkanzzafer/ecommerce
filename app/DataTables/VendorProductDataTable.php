<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class VendorProductDataTable extends DataTable
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
                $editBtn = "<a href='" . route('vendor.products.edit', $query->id) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('vendor.products.destroy', $query->id) . "' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";
                $moreBtn = ' <div class="btn-group dropstart">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cog"></i>
                </button>
                <ul class="dropdown-menu">
                <a class="dropdown-item has-icon" href="'.route('vendor.products-image-gallery.showTable',$query->id).'"><i class="far fa-heart"></i> Resim Galerisi</a>
                <a class="dropdown-item has-icon" href="'.route('vendor.products-variant.showTable',$query->id).'"><i class="far fa-file"></i> Varyant</a>
                </ul>
              </div>';
                return $editBtn . $deleteBtn . $moreBtn;
            })
            ->addColumn('thumb_image', function ($query) {
                return $img = "<img width='100' height='100' src='" . asset($query->thumb_image) . "' ></img>";
            })
            ->addColumn('status', function ($query) {
                if ($query->status == 1) {
                    $button = '<div class="form-check form-switch">
                <input checked class="form-check-input change-status" type="checkbox" role="switch" id="flexSwitchCheckDefault"  data-id="' . $query->id . '">
              </div>';
                } else {
                    $button = '<div class="form-check form-switch">
                <input class="form-check-input change-status" type="checkbox" role="switch" id="flexSwitchCheckDefault" data-id="' . $query->id . '">
              </div>';
                }
                return $button;
            })
            ->addColumn('product_type', function ($query) {
                switch ($query->product_type) {
                    case 'new_arrival':
                        return '<i class="badge bg-success">New Arrival</i>';
                        break;
                    case 'featured':
                        return '<i class="badge bg-warning">Featured Product</i>';
                        break;
                    case 'top_product':
                        return '<i class="badge bg-info">Top Product</i>';
                        break;

                    case 'best_product':
                        return '<i class="badge bg-danger">Best Product</i>';
                        break;

                    default:
                        return '<i class="badge bg-dark">None</i>';
                        break;
                }
            })
            ->addColumn('is_approved',function($query){
                if($query->is_approved==1){
                    return '<i class="badge bg-success">Onaylandı</i>';
                }else{
                    return '<i class="badge bg-warning">Onaylanmadı</i>';
                }
            })
            ->rawColumns(['thumb_image', 'product_type', 'status', 'action','is_approved'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('vendor_id',Auth::user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('vendorproduct-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
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
            Column::make('name'),
            Column::make('thumb_image'),
            Column::make('price'),
            Column::make('is_approved')->title('Onay Durumu'),
            Column::make('product_type')->width(200),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(250)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorProduct_' . date('YmdHis');
    }
}
