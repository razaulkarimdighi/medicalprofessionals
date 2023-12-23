<?php

namespace App\DataTables;

use App\Models\User;
use App\Models\Assignment;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AssignAnesthesiologistDataTable extends DataTable
{
   /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            // ->addColumn('action', function ($item) {
            //     $buttons = '';
            //         $buttons .= '<a class="dropdown-item" href="' . route('admin.anesthesiologists.edit', $item->id) . '" title="Edit"><i class="mdi mdi-square-edit-outline"></i> Edit </a>';

            //     // TO-DO: need to chnage the super admin ID to 1, while Super admin ID will 1
            //             $buttons .= '<form action="' . route('admin.anesthesiologists.destroy', $item->id) . '"  id="delete-form-' . $item->id . '" method="post" style="">
            //             <input type="hidden" name="_token" value="' . csrf_token() . '">
            //             <input type="hidden" name="_method" value="DELETE">
            //             <button class="dropdown-item text-danger" onclick="return makeDeleteRequest(event, ' . $item->id . ')"  type="submit" title="Delete"><i class="mdi mdi-trash-can-outline"></i> Delete</button></form>
            //             ';

            //     return '<div class="btn-group dropleft">
            //     <a href="#" onclick="return false;" class="btn btn-sm btn-dark text-white dropdown-toggle dropdown" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
            //     <div class="dropdown-menu">
            //     ' . $buttons . '
            //     </div>
            //     </div>';
            // })
             ->editColumn('practicioner_id', function ($item) {
                 $first_name = $item->practicioner->first_name;
                 $last_name = $item->practicioner->last_name;

                 return $first_name.' '.$last_name;
             })
             ->editColumn('anesthesiologist_id', function ($item) {
                $first_name = $item->anesthesiologist->first_name;
                $last_name = $item->anesthesiologist->last_name;

                return $first_name.' '.$last_name;
            })
            //->editColumn('status',function ($item){
            //     $badge = $item->status == GlobalConstant::STATUS_ACTIVE ? "bg-success" : "bg-danger";
            //     return '<span class="badge ' . $badge . '">' . Str::upper($item->status) . '</span>';
            // })->editColumn('user_type',function ($item){
            //     return '<span class="text-capitalize">' . $item->user_type. '</span>';
            // })->filterColumn('first_name', function ($query, $keyword) {
            //     $sql = "CONCAT(users.first_name,'-',users.last_name)  like ?";
            //     $query->whereRaw($sql, ["%{$keyword}%"]);
            //  })
            ->rawColumns(['action', 'practicioner_id','anesthesiologist_id']);
            // ->setRowId('id');

    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Assignment $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('id', 'DESC')->select('assignments.*');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('assignment-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle();
                    //->addAction(['width' => '55px', 'class' => 'text-center', 'printable' => false, 'exportable' => false, 'title' => 'Action']);

    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {

        return [
//            Column::computed('DT_RowIndex', 'SL#'),
Column::make('practicioner_id', 'practicioner_id')->title('Practioner'),
Column::make('anesthesiologist_id', 'anesthesiologist_id')->title('Anesthesiologist'),
Column::make('assignment_date', 'assignment_date')->title('Assignment Date'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Assignment_' . date('YmdHis');
    }

}
