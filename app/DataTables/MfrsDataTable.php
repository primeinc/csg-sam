<?php

namespace App\DataTables;

use App\Models\Mfr;
use Yajra\Datatables\Services\DataTable;

class MfrsDataTable extends DataTable
{
    // protected $printPreview  = 'path.to.print.preview.view';

    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
//            ->addColumn('action', 'path.to.action.view')
            ->addColumn('action', function ($data) {
//                return '<a href="#edit-'.$data->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                return $data->action_buttons;
            })
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $dealers = Mfr::query();

        return $this->applyScopes($dealers);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->addAction(['width' => '60px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            'id'            => ['title' => 'ID'],
            'name'          => ['title' => 'Manufacturer Name'],
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

    /**
     * Get builder parameters.
     *
     * @return array
     */
    protected function getBuilderParameters()
    {
        return [
            'lengthMenu' => [[50, 75, 100, -1], [50, 75, 100, 'All']],
            'order'   => [[0, 'desc']],
            'dom' => '<\'box-body\'lfrtip><\'box-footer\'B>',
            'buttons' => ['excel', 'pdf', 'print'],
        ];
    }
}
