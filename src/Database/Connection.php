<?php

namespace Senhung\MySQL\Database;

use mysqli;
use Senhung\Config\Configuration;

class Connection
{
    /**
     * The database connection
     *
     * @var mysqli $database
     */
    private static $database;

    /**
     * Variable to determine if the static object exists
     *
     * @var bool
     */
    private static $initialized = false;

    /**
     * Initialize static object
     * @param string $databaseName
     */
    private static function initialize(string $databaseName)
    {
        if (self::$initialized)
            return;

        self::$database = self::connect($databaseName);
        self::$initialized = true;
    }

    /**
     * Connecting to MySQL
     *
     * @param string $databaseName
     * @return mysqli
     */
    private static function connect(string $databaseName): mysqli
    {
        /* Set config path */
        Configuration::setPath('.env');

        /* Initialize config */
        Configuration::initializeConfigs();

        $database = new mysqli(
            Configuration::read($databaseName . '_HOST'),
            Configuration::read($databaseName . '_USERNAME'),
            Configuration::read($databaseName . '_PASSWORD'),
            Configuration::read($databaseName . '_DATABASE'),
            Configuration::read($databaseName . '_PORT')
        );

        if ($database->connect_errno) {
            die("Database connection error (" . $database->connect_errno . "): " . $database->connect_error . "\n");
        }

        return $database;
    }

    /**
     * @param string $query
     * @param string $databaseName
     * @return bool|\mysqli_result
     */
    public static function query(string $query, string $databaseName = 'DB')
    {
        self::initialize($databaseName);

        $result = self::$database->query($query);

        if (!$result) {
            exit(mysqli_error(self::$database) . "\n" . $query . "\n\n");
        }

        return $result;
    }
}
