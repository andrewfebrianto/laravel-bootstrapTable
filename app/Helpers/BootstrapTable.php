<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class BootstrapTable
{
    /**
     * Create data JSON for bootstrap-table
     *
     * @param Request $request
     * @param string $query
     * @param boolean $softDelete
     * @param boolean $showTrash
     * @return JSON
     */
    public static function create(Request $request, $query, $softDelete = false, $showTrash = false)
    {
        if ($softDelete){
            $query = (!$showTrash) ? $query->whereNull('deleted_at') : $query->whereNotNull('deleted_at');
        }

        if ($filter = json_decode($request->input('filter'), true)) {
            foreach ($filter as $key => $value) {
                $query = $query->where($key, 'like', '%' . $value . '%');
            }
        }

        if ($search = $request->input('search')) {
            $query = $query->where(function ($q) use ($query, $search) {
                foreach ($query->columns as $column) {
                    $q->orWhere($column, 'like', '%' . $search . '%');
                }
            });
        }

        if ($sort = $request->input('sort')) {
            $query = $query->orderBy($sort, $request->input('order'));
        }

        $total = $query->count();

        if ($offset = $request->input('offset')) {
            $query = $query->offset($offset);
        }

        if ($limit = $request->input('limit')) {
            $query = $query->limit($limit);
        }

        $result = [
            'total' => $total,
            'rows' => $query->get(),
        ];

        return json_encode($result);
    }

    /**
     * Create data JSON for bootstrap-table will retrieve only soft deleted models
     *
     * @param Request $request
     * @param [type] $query
     * @return void
     */
    public static function onlyTrashed(Request $request, $query)
    {
        return $this->create($request, $query, true, true);
    }
}