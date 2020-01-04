<?php


namespace FluidTech\SpockDataTables;

/**
 * Class DataTableResponse
 * @package FluidTech\SpockDataTables
 *
 * Represents the response body specified by datatables.net plugin.
 */
class DataTableResponse
{
    /**
     * @var int The draw key maintained by datatables.net.
     */
    public $draw;

    /**
     * @var int The total numbers records present in the db.
     */
    public $recordsTotal;

    /**
     * @var int The total number of records after filtration
     */
    public $recordsFiltered;

    /**
     * @var array A list of records fetched from the db.
     */
    public  $data;

    public function __construct($draw, $recordsTotal, $recordsFiltered, $data)
    {
        $this->draw = $draw;
        $this->recordsTotal = $recordsTotal;
        $this->recordsFiltered = $recordsFiltered;
        $this->data = $data;
    }
}
