<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;

class MedicalPractitionerDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($item) {
                $buttons = '';
                    $buttons .= '<a class="dropdown-item" href="' . route('admin.medical_practitioners.edit', $item->id) . '" title="Edit"><i class="mdi mdi-square-edit-outline"></i> Edit </a>';
                    $buttons .= '<a class="dropdown-item" href="' . route('admin.medical_practitioners.show', $item->id) . '" title="Edit"><i class="fa fa-eye" aria-hidden="true"></i> Show </a>';
                    $buttons .= '<a class="dropdown-item" href="' . route('admin.assign.anesthesiologist', $item->id) . '" title="Assign Anesthesiologist"><i class="fa fa-address-book" aria-hidden="true"></i> Assign Anesthesiologist </a>';

                // TO-DO: need to chnage the super admin ID to 1, while Super admin ID will 1
                        $buttons .= '<form action="' . route('admin.medical_practitioners.destroy', $item->id) . '"  id="delete-form-' . $item->id . '" method="post" style="">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="dropdown-item text-danger" onclick="return makeDeleteRequest(event, ' . $item->id . ')"  type="submit" title="Delete"><i class="mdi mdi-trash-can-outline"></i> Delete</button></form>
                        ';

                return '<div class="btn-group dropleft">
                <a href="#" onclick="return false;" class="btn btn-sm btn-dark text-white dropdown-toggle dropdown" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                <div class="dropdown-menu">
                ' . $buttons . '
                </div>
                </div>';
            })
            ->editColumn('first_name', function ($item) {
                return $item->full_name;
            })
            ->editColumn('permission',function ($item){
                //  $badge = $item->permission == 'accepted' ? "bg-success" : "bg-danger";
                //  return '<span class="badge ' . $badge . '">' . Str::upper($item->permission) . '</span>';

                 $badge = $item->permission == 'accepted' ? "bg-success" :  $badge = $item->permission == 'rejected'? "bg-danger" : "bg-primary";
                 return '<span class="badge ' . $badge . '">' . Str::upper($item->permission) . '</span>';
             })
            // ->editColumn('status',function ($item){
            //     $badge = $item->status == User::STATUS_ACTIVE ? "bg-success" : "bg-danger";
            //     return '<span class="badge ' . $badge . '">' . Str::upper($item->status) . '</span>';
            // })
           // ->editColumn('user_type',function ($item){
            //     return '<span class="text-capitalize">' . $item->user_type. '</span>';
            // })->filterColumn('first_name', function ($query, $keyword) {
            //     $sql = "CONCAT(users.first_name,'-',users.last_name)  like ?";
            //     $query->whereRaw($sql, ["%{$keyword}%"]);
            // })
            ->rawColumns(['action', 'first_name','permission']);
            // ->setRowId('id');

    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->where('user_type', '=',User::USER_TYPE_MEDICAL_PRACTICES)->orderBy('id', 'DESC')->select('users.*');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('user-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->addAction(['width' => '55px', 'class' => 'text-center', 'printable' => false, 'exportable' => false, 'title' => 'Action']);

    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {

        return [
//            Column::computed('DT_RowIndex', 'SL#'),
            // Column::make('user_type', 'user_type')->title('Medical Practitioners'),
            Column::make('first_name', 'first_name')->title('Name'),
            Column::make('permission', 'permission')->title('Permission'),
            Column::make('phone', 'phone')->title('Phone'),
            Column::make('email', 'email')->title('Email'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}
