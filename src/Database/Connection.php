<?php

namespace Senhung\DB\Database;

use mysqli;
use Senhung\Config\Configuration;

class Connection
{
    /**
     * The database connection
     *
     * @var mysqli $database
     */
    private $database;

    /**
     * Connection constructor.
     * @param string $databaseName
     */
    public function __construct(string $databaseName = 'DB')
    {
        $this->connect($databaseName);
    }

    /**
     * Connecting to MySQL
     *
     * @param string $databaseName
     * @return void
     */
    private function connect(string $databaseName): void
    {
        $this->database = new mysqli(
            Configuration::read($databaseName . '_HOST'),
            Configuration::read($databaseName . '_USERNAME'),
            Configuration::read($databaseName . '_PASSWORD'),
            Configuration::read($databaseName . '_DATABASE'),
            Configuration::read($databaseName . '_PORT')
        );

        if ($this->database->connect_errno) {
            die("Database connection error (" . $this->database->connect_errno . "): " . $this->database->connect_error . "\n");
        }
    }

    /**
     * @param string $query
     * @param bool $parsed
     * @return array|\mysqli_result
     */
    public function query(string $query, bool $parsed = false)
    {
        $result = $this->database->query($query);

        if (!$result) {
            exit(mysqli_error($this->database) . "\n" . $query . "\n\n");
        }

        return $parsed ? $this->parseResult($result) : $result;
    }

    /**
     * Parse mysql result to array
     *
     * @param \mysqli_result $result
     * @return array
     */
    private function parseResult(\mysqli_result $result): array
    {
        $parsedResults = [];

        while ($parsedResult = $result->fetch_assoc()) {
            $parsedResults[] = $parsedResult;
        }

        return $parsedResults;
    }
}
