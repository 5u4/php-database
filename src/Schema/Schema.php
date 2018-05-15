<?php

namespace Senhung\DB\Schema;

use Senhung\DB\Database\Connection;

class Schema
{
    /**
     * Create Table
     *
     * @param string $tableName
     * @param callable $function
     * @param bool $ifNotExists
     * @return void
     */
    public static function create(string $tableName, callable $function, bool $ifNotExists = true): void
    {
        /* Get Table Columns + Constraints */
        $table = new Blueprint($tableName, $ifNotExists);

        call_user_func($function, $table);

        /* Create Table */
        try {
            $db = new Connection();
            $db->query($table);
        }

        /* Error */
        catch (\Exception $exception) {
            die($exception->getMessage());
        }
    }
}
