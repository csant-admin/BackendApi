<?php

namespace App\Services;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DynamicInsertService
{
    /**
     * The name of the table this service operates on.
     *
     * @var string
     */
    protected string $table;

    /**
     * Columns to exclude automatically (like primary keys).
     *
     * @var array
     */
    protected array $excludedColumns = ['id'];

    /**
     * Constructor — define which table this service will insert into.
     *
     * @param string $table
     */
    public function __construct(string $table)
    {
        $this->table = $table;
    }

    /**
     * Dynamically insert a record into the database.
     * Assigns values from request if available, otherwise sets them to null.
     *
     * @param Request|array $input
     * @param bool $returnId Whether to return inserted ID
     * @return int|bool Inserted ID or true/false on success
     */
    public function insert(Request|array $input, bool $returnId = false): int|bool
    {
        $data = $this->prepareData($input);

        return $returnId
            ? DB::table($this->table)->insertGetId($data)
            : DB::table($this->table)->insert($data);
    }

     /**
     * Convenience method: insert data using a Model instance.
     */
    public function insertUsingModel(Model $model, Request|array $input, bool $returnId = false): int|bool
    {
        $this->table = $model->getTable();
        return $this->insert($input, $returnId);
    }
    
    /**
     * Prepare the insertable data from the request or array.
     *
     * @param Request|array $input
     * @return array
     */
    protected function prepareData(Request|array $input): array
    {
        $inputArray = $input instanceof Request ? $input->all() : (array) $input;

        $columns = $this->getInsertableColumns();
        $data = [];

        foreach ($columns as $column) {
            $data[$column] = $inputArray[$column] ?? null;
        }

        // Handle timestamps automatically if present
        $this->applyTimestamps($data);

        return $data;
    }

    /**
     * Get insertable columns from the schema, excluding unwanted ones.
     *
     * @return array
     */
    protected function getInsertableColumns(): array
    {
        $columns = Schema::getColumnListing($this->table);
        return array_values(array_diff($columns, $this->excludedColumns));
    }

    /**
     * Automatically set timestamps if table has them.
     *
     * @param array &$data
     * @return void
     */
    protected function applyTimestamps(array &$data): void
    {
        $now = now();

        if (Schema::hasColumn($this->table, 'created_at') && !isset($data['created_at'])) {
            $data['created_at'] = $now;
        }

        if (Schema::hasColumn($this->table, 'updated_at') && !isset($data['updated_at'])) {
            $data['updated_at'] = $now;
        }
    }
}
