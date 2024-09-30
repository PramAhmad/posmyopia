<?php

namespace App\DataTables;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UnitDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function($query) {
                return view('datatable-actions.unit', compact('query'));
            })
            ->editColumn('toko_id', function($query) {
                return $query->toko->nama_toko;
            })
            ->setRowId('id')
            ->rawColumns(['role']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Unit $model): QueryBuilder
    {
        if(auth()->user()->hasRole('superadmin')){
            $model->newQuery();
        }else{
            $model = Unit::where('toko_id', auth()->user()->toko_id);
        };

        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('unit-table')
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
                    ])
                    ->parameters([
                        'language' => [
                            'processing' => '<div class="shadow p-3"><div class="spinner-border spinner-border-sm text-primary" role="status"></div> Processing...</div>'
                        ]
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            [
                'defaultContent' => '',
                'data'           => 'DT_RowIndex',
                'name'           => 'DT_RowIndex',
                'title'          => '#',
                'render'         => null,
                'orderable'      => false,
                'searchable'     => false,
                'exportable'     => false,
                'printable'      => true,
                'footer'         => '',
                'width' => '5%',
                'class' => 'text-center',
            ],
         
            Column::make('name'),
            Column::make('slug'),
            Column::make('short_code'),
            $this->getTokoIdColumn(),
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
        return 'Unit_' . date('YmdHis');
    }
    protected function getTokoIdColumn()
    {
        if(auth()->user()->hasRole('superadmin')){
            return Column::make('toko_id');
        }else{
            return Column::make('toko_id')->visible(false);
        }
    }
}
