<?php

namespace App\DataTables;

use App\Models\Product;
use App\Models\Proeduct;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class ProductDataTable extends DataTable
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
                $editBtn = "<a href='" . route('admin.product.edit', $query->id) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('admin.product.destroy', $query->id) . "' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";
                $moreBtn=' <div class="dropdown dropleft d-inline ml-2">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-cog"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item has-icon" href="'.route('admin.products-image-gallery.index',['product'=>$query->id]).'"><i class="far fa-heart"></i> Resim Galerisi</a>
                  <a class="dropdown-item has-icon" href="'.route('admin.products-variant.showTable',$query->id).'"><i class="far fa-file"></i> Varyant</a>

                </div>
              </div>';
                return $editBtn . $deleteBtn.$moreBtn;
            })
            ->addColumn('thumb_image', function ($query) {
                return $img = "<img width='100' height='100' src='" . asset($query->thumb_image) . "' ></img>";
            })
            ->addColumn('status', function ($query) {
                if($query->status==1){
                    $button='<label class="custom-switch mt-12">
                    <input type="checkbox" checked name="" data-id="'.$query->id.'" class="custom-switch-input change-status">
                    <span class="custom-switch-indicator"></span>
                    </label>';
                }else{
                    $button='<label class="custom-switch mt-12">
                    <input type="checkbox" name=""  data-id="'.$query->id.'" class="custom-switch-input change-status">
                    <span class="custom-switch-indicator"></span>
                    </label>';
                }
                        return $button;
            })
            ->addColumn('product_type', function ($query) {
                switch ($query->product_type) {
                    case 'new_arrival':
                        return '<i class="badge badge-success">New Arrival</i>';
                        break;
                    case 'featured':
                        return '<i class="badge badge-warning">Featured Product</i>';
                        break;
                    case 'top_product':
                        return '<i class="badge badge-info">Top Product</i>';
                        break;

                    case 'best_product':
                        return '<i class="badge badge-danger">Best Product</i>';
                        break;

                    default:
                        return '<i class="badge badge-dark">None</i>';
                        break;
                }
            })
            ->addColumn('category_id', function ($query) {
                return $query->category->name;
            })

            ->filterColumn('category_id',function($query,$keyword){
                $query->whereHas('category',function($query) use ($keyword){
                    $query->where('name','like',"%$keyword%");
                });
            })

            ->rawColumns(['thumb_image', 'product_type','status','action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        //return $model->newQuery();
       // return $model->where('vendor_id',Auth()->user()->vendor->id)->newQuery();
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('product-table')
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
            Column::make('category_id'),
            Column::make('price'),
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
        return 'Product_' . date('YmdHis');
    }
}
