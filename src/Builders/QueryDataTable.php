<?php


namespace FluidTech\SpockDataTables\Builders;


use FluidTech\SpockDataTables\DataTableResponse;
use Illuminate\Database\Query\Builder;

class QueryDataTable
{
    /**
     * @var Builder Stores the original query builder.
     * Will be used to fetch the count of all records present in the database.
     */
    protected $originalQuery;

    /**
     * @var Builder The modified query builder.
     * Will be used to fetch and filter records according to the request.
     */
    protected $modifiedQuery;

    /**
     * @var array A list of columns that needs to be fetched.
     * Note : these columns should be in the exact same order as specified at the client side.
     */
    protected $columns;


    public function __construct($queryBuilder, $columns)
    {
        $this->originalQuery = $queryBuilder;
        $this->modifiedQuery = $queryBuilder;
        $this->columns = $columns;
    }

    /**
     * This method applies all the given rules, constructs the query and returns the response for same.
     *
     */
    public function make()
    {
        // Searching through all the columns
        if(isset(request()->input("search")["value"])) {
            $key = request()->input("search")["value"];
            $this->search($key);
        }

        // Sorting the list by the given column
        if(request()->input("order")) {
            $columnName = $this->columns[intval(request()->input("order")['0']["column"])];
            $sortDirection = request()->input("order")['0']["dir"];
            $this->sort($columnName, $sortDirection);
        }

        // If the length is -1 then it means all records needs to be fetched .i.e. no pagination is required.
        // Thus we'll paginate only if the length is not equal to -1
        if(request()->input("length") != -1) {
            $start = request()->input("start");
            $length = request()->input("length");
            $this->paginate($start, $length);
        }

        // Executing the generated query and fetching the row count
        $results = $this->modifiedQuery->get();
        $number_filtered_row = count($results);

        $data = [];
        // Proceed only if at least one row is returned
        if($number_filtered_row > 0) {
            // Iterating through each row
            foreach ($results as $result) {
                $sub_array = [];
                // Iterating and dumping each column as specified
                foreach ($this->columns as $column) {
                    $sub_array[] = $result->$column;
                }
                $data[] = $sub_array;
            }
        }

        $expectedResponse = new DataTableResponse(request()->input("draw"),
            $this->totalCount(),
            $results->count(),
            $data
        );

        return response()->json($expectedResponse, 200);
    }

    private function totalCount()
    {
        return $this->originalQuery->get()
            ->count();
    }

    private function paginate($offset, $limit)
    {
        $this->modifiedQuery = $this->modifiedQuery->offset($offset)
            ->limit($limit);
    }

    /**
     * @param $column string Name of the column by which results should be sorted/
     * @param $direction string Direction of order.
     * Sorts the current list according to the given column and its direction.
     */
    private function sort($column, $direction)
    {
        $this->modifiedQuery = $this->modifiedQuery->orderBy($column, $direction);
    }

    /**
     * @param $key string The search key passed by the client
     * Modifies the query by appending where clause to compare the given key with all the columns
     */
    private function search($key)
    {
        // TODO : Sanitize the given input key or else it will leave the plugin vulnerable to SQL injections.
        foreach ($this->columns as $column) {
            $this->modifiedQuery = $this->modifiedQuery->orWhere($column, "LIKE", "%$key%");
        }
    }
}
