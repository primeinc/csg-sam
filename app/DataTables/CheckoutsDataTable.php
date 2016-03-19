<?php

namespace App\DataTables;

use App\Models\Checkout;
use Carbon\Carbon;
use Yajra\Datatables\Services\DataTable;

class CheckoutsDataTable extends DataTable
{
    // protected $printPreview  = 'path.to.print.preview.view';

    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables->eloquent($this->query())//            ->addColumn('action', 'path.to.action.view')
        ->editColumn('asset_id', function ($data) {

            return '<a href=' . route('samples.show', $data->asset_id) . '>' . $data->asset_id . '</a>';
        })
        ->editColumn('dealer_id', function ($data) {

            return '<a href=' . route('samples.out.dsr', $data->dealer_id) . '>' . $data->dealer->name . '</a>';
        })
        ->editColumn('user_id', function ($data) {

            return '<a href=' . route('samples.out.rep', $data->user_id) . '>' . $data->user->name . '</a>';
        })
        ->editColumn('created_at', function ($data) {

            return $data->created_at ? with(new Carbon($data->created_at))->format('m/d/Y') : '';
        })
        ->editColumn('expected_return_date', function ($data) {

            return $data->expected_return_date ? with(new Carbon($data->expected_return_date))->format('m/d/Y') : '';
        })->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $checkouts = Checkout::query()
            ->addSelect('id')
            ->addSelect('asset_id')
            ->addSelect('user_id')
            ->addSelect('dealer_id')
            ->addSelect('project')
            ->addSelect('expected_return_date')
            ->addSelect('created_at')
            ->where('returned_date', '=', null)
            ->with('user')->with('dealer')->with('dealer.dealership')->with('asset');

        return $this->applyScopes($checkouts);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()->columns($this->getColumns())->ajax('')->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            'id' => ['name' => 'id', 'title' => 'Id', 'searchable' => false],
            'asset_id' => ['name' => 'asset_id', 'title' => 'Asset'],
            'dealer_id' => ['name' => 'dealer_id', 'title' => 'DSR', 'searchable' => false],
            'dealer.dealership.name' => ['name' => 'dealer.dealership.name', 'title' => 'Dealership', 'orderable' => false, 'searchable' => false],
            'user_id' => ['name' => 'user_id', 'title' => 'CSG Rep', 'searchable' => false],
            'project' => ['name' => 'project', 'title' => 'Project'],
            'created_at' => ['name' => 'created_at', 'title' => 'Date Out', 'searchable' => false],
            'expected_return_date' => ['name' => 'expected_return_date', 'title' => 'Return Date', 'searchable' => false],
        ];
    }

    /**
     * Get builder parameters.
     *
     * @return array
     */
    protected function getBuilderParameters()
    {
        return [
            'lengthMenu' => [[25, 50, 75, 100, -1], [25, 50, 75, 100, 'All']],
            'order' => [[6, 'asc']],
            'dom' => '<\'box-body\'lfrtip><\'box-footer\'B>',
            'buttons' => ['excel', 'pdf', 'print'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'active-checkouts-' . Carbon::now()->format('m-d-Y');
    }
}
