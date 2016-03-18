<?php

namespace App\DataTables;

use App\Models\Dealer;
use DB;
use Yajra\Datatables\Services\DataTable;

class DealersDataTable extends DataTable
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
        ->editColumn('dealers.name', function ($data) {
            $link = '<a href=' . route('dealers.show', $data->id) . '>' . $data->name . '</a>';

            return $link;
        })
        ->editColumn('user.name', function ($data) {
            $link = '<a href=' . route('samples.out.rep', $data->user->id) . '>' . $data->user->name . '</a>';

            return $link;
        })
        ->addColumn('action', function ($data) {

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
        $dealers = Dealer::query()
            ->addSelect('dealers.id')
            ->addSelect('dealership_id')
            ->addSelect('user_id')
            ->addSelect('dealers.name')
            ->addSelect(DB::raw('(select count(*) from checkouts where dealer_id = dealers.id and returned_date is null) as active_checkouts'))
            ->addSelect(DB::raw('(select count(*) from checkouts where dealer_id = dealers.id) as total_checkouts'))
            ->with('user')->with('dealership');

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
            'id' => ['name' => 'dealers.id', 'title' => 'ID'],
            'dealership.name' => ['name' => 'dealership.name', 'title' => 'Dealership'],
            'dealers.name' => ['name' => 'dealers.name', 'title' => 'DSR'],
            'user.name' => ['name' => 'user.name', 'title' => 'CSG Rep'],
            'active_checkouts' => ['name' => 'active_checkouts', 'title' => 'Active', 'searchable' => false],
            'total_checkouts' => ['name' => 'total_checkouts', 'title' => 'Total', 'searchable' => false],
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
