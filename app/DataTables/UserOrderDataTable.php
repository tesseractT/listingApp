<?php

namespace App\DataTables;

use App\Models\UserOrder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Order;

class UserOrderDataTable extends DataTable
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
                $show = '<a href ="' . route('user.orders.show', $query->id) . '" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>';

                return $show;
            })
            ->addColumn(
                'name',
                function ($query) {
                    return $query->user->name;
                }
            )

            ->addColumn(
                'package',
                function ($query) {
                    return $query->package->name;
                }
            )
            ->addColumn('paid', function ($query) {
                return number_format($query->base_amount, 2) . ' ' . $query->base_currency;
            })
            ->addColumn('paid_in', function ($query) {
                return $query->paid_currency;
            })
            ->addColumn('payment_status', function ($query) {
                if ($query->payment_status === 'completed') {
                    return "<span class='badge bg-success'>Completed</span>";
                } elseif ($query->payment_status === 'pending') {
                    return "<span class='badge bg-warning'>Pending</span>";
                } else {
                    return "<span class='badge bg-danger'>Failed</span>";
                }
            })
            ->addColumn('payment_method', function ($query) {
                return $query->payment_method;
            })
            ->rawColumns(['payment_status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        return $model->where('user_id', auth()->user()->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('userorder-table')
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
            Column::make('name'),
            Column::make('package'),
            Column::make('paid'),
            Column::make('paid_in'),
            Column::make('payment_method'),
            Column::make('payment_status'),
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
        return 'UserOrder_' . date('YmdHis');
    }
}
