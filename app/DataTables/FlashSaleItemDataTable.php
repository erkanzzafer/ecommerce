<?php

namespace App\DataTables;

use App\Models\FlashSaleItem;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class FlashSaleItemDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'flashsaleitem.action')
            ->addColumn('product_id', function ($query) {
                return "<a href='".route('admin.product.edit',$query->product->id)."'>".$query->product->name."</a>";

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
            ->addColumn('show_at_home', function ($query) {
                if($query->show_at_home==1){
                    $button='<label class="custom-switch mt-12">
                    <input type="checkbox" checked name="" data-id="'.$query->id.'" class="custom-switch-input change-at-home-status">
                    <span class="custom-switch-indicator"></span>
                    </label>';
                }else{
                    $button='<label class="custom-switch mt-12">
                    <input type="checkbox" name=""  data-id="'.$query->id.'" class="custom-switch-input change-at-home-status">
                    <span class="custom-switch-indicator"></span>
                    </label>';
                }
                        return $button;
            })
            ->addColumn('action', function ($query) {
                $deleteBtn = "<a href='" . route('admin.flash-sale-status.destroy', $query->id) . "' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";
                return $deleteBtn;
            })
            ->rawColumns(['product_id','status','show_at_home','action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(FlashSaleItem $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('flashsaleitem-table')
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
            Column::make('product_id')->title('Ürün İsmi'),
            Column::make('show_at_home')->title('Ekranda Görülme'),
            Column::make('status')->title('Durum'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'FlashSaleItem_' . date('YmdHis');
    }
}
