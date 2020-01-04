<?php


namespace FluidTech\SpockDataTables;


use FluidTech\SpockDataTables\Builders\QueryDataTable;

class DataTable
{
    /**
     * Constructs a instance of eloquent based datatable
     * @param $queryBuilder
     * @param $columns array A list of columns that needs to be fetched.
     * @return QueryDataTable
     */
    public static function of($queryBuilder, $columns)
    {
        return new QueryDataTable($queryBuilder, $columns);
    }
}
