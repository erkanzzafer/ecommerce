<?php

namespace App\DataTables;

use App\Models\ChildCategory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class ChildCategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'childcategory.action')
            ->addColumn('action', function ($query) {
                $editBtn = "<a href='" . route('admin.childcategory.edit', $query->id) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('admin.childcategory.destroy', $query->id) . "' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";
                return $editBtn . $deleteBtn;
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
            ->addColumn('category_id', function ($query) {
                    return $query->category->name;
            })
            ->addColumn('sub_category_id', function ($query) {
                return $query->subcategories->name;
        })
        ->filterColumn('category_id',function($query,$keyword){
            $query->whereHas('category',function($query) use ($keyword){
                $query->where('name','like',"%$keyword%");
            });
        })
        ->filterColumn('sub_category_id',function($query,$keyword){
            $query->whereHas('subcategories',function($query) use ($keyword){
                $query->where('name','like',"%$keyword%");
            });
        })
            ->rawColumns(['action','status','sub_category_id'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ChildCategory $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('childcategory-table')
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
            Column::make('slug'),
            Column::make('category_id')->title('Kategori'),
            Column::make('sub_category_id')->title('Alt Kategori'),
            Column::make('status')->title('Durum'),
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
        return 'ChildCategory_' . date('YmdHis');
    }
}
