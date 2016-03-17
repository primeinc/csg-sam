<?php

namespace App\DataTables;

use App\Models\Dealership;
use DB;
use Yajra\Datatables\Services\DataTable;

class DealershipsDataTable extends DataTable
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
        ->addColumn('action', function ($data) {
            //                return '<a href="#edit-'.$data->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            return $data->action_buttons;
        })->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $dealers = Dealership::query()
            ->addSelect('dealerships.id')
            ->addSelect('dealerships.name')
            ->addSelect(DB::raw('(SELECT SUM(x.total) FROM ( SELECT dealers.id, dealership_id,
             ( SELECT COUNT(*) AS total FROM `checkouts` WHERE dealer_id = dealers.id and returned_date IS NULL ) AS total FROM `dealers` ) x
              WHERE dealerships.id = x.dealership_id) AS active_checkouts'))
            ->addSelect(DB::raw('(SELECT SUM(x.total) FROM ( SELECT dealers.id, dealership_id,
             ( SELECT COUNT(*) AS total FROM `checkouts` WHERE dealer_id = dealers.id ) AS total FROM `dealers` ) x
              WHERE dealerships.id = x.dealership_id) AS total_checkouts'));

        return $this->applyScopes($dealers);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()->columns($this->getColumns())->ajax('')->addAction(['width' => '60px'])->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            'id' => ['title' => 'ID'],
            'name' => ['title' => 'Dealership'],
            'active_checkouts' => ['title' => 'Active'],
            'total_checkouts' => ['title' => 'Total'],
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
            'lengthMenu' => [[50, 75, 100, -1], [50, 75, 100, 'All']],
            'order' => [[0, 'desc']],
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
        return 'dealers';
    }
}
