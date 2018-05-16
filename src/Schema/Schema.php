<?php

namespace Senhung\DB\Schema;

use Senhung\DB\Database\Connection;

class Schema
{
    /**
     * Create Table
     *
     * @param string $tableName
     * @param callable $tableBuildingFunction
     * @param bool $ifNotExists
     * @param string $database
     * @return void
     */
    public static function create(
        string $tableName,
        callable $tableBuildingFunction,
        bool $ifNotExists = true,
        string $database = 'DB'
    ): void {
        /* Get Table Columns + Constraints */
        $table = new Blueprint($tableName, $ifNotExists);

        /* Call Table Building Function */
        call_user_func($tableBuildingFunction, $table);

        /* Create Table */
        try {
            $db = new Connection($database);
            $db->query($table);
            $db->close();
        }

        /* Error Handling */
        catch (\Exception $exception) {
            die($exception->getMessage());
        }
    }

    /**
     * Drop Table
     *
     * @param string $tableName
     * @param bool $ifExists
     * @param string $database
     */
    public static function drop(string $tableName, bool $ifExists = true, string $database = 'DB'): void
    {
        /* Drop Query */
        $query = "DROP TABLE " . ($ifExists ? "IF EXISTS " : "") . "`" . $tableName . "`;";

        /* Drop Table */
        try {
            $db = new Connection($database);
            $db->query($query);
            $db->close();
        }

        /* Error Handling */
        catch (\Exception $exception) {
            die($exception->getMessage());
        }
    }
}
