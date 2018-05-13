<?php

namespace Senhung\MySQL\Schema;

class Blueprint
{
    /**
     * IF NOT EXISTS
     *
     * @var bool $ifNotExists
     */
    private $ifNotExists = true;

    /**
     * Table Name
     *
     * @var string $tableName
     */
    private $tableName = '';

    /**
     * Column name
     *
     * @var string $columnName
     */
    private $mostRecentColumn;

    /**
     * Columns for building tables
     *
     * @var array $columns
     */
    private $columns = [];

    /**
     * Constraints for building tables
     *
     * @var array $constraints
     */
    private $constraints = [];

    /**
     * Table building constants
     */
    private const DEFAULT_STRING_LENGTH = 50;
    private const DEFAULT_INT_LENGTH = 11;

    /**
     * Base Types
     */
    private const STRING_BASETYPE = 'VARCHAR';
    private const INT_BASETYPE = 'INT';

    /**
     * Constraints
     */
    private const NOT_NULL = 'NOT NULL';
    private const PRIMARY_KEY = 'PRIMARY KEY';
    private const UNIQUE = 'UNIQUE';
    private const AUTO_INCREMENT = 'AUTO_INCREMENT';

    /**
     * Blueprint constructor.
     * @param string $tableName
     * @param bool $ifNotExists
     */
    public function __construct(string $tableName, bool $ifNotExists = true)
    {
        $this->tableName = $tableName;
        $this->ifNotExists = $ifNotExists;
    }

    /**
     * Create table MySQL query
     *
     * @return string
     */
    public function __toString(): string
    {
        /* Create table */
        $query = "CREATE TABLE ";

        if ($this->ifNotExists) {
            $query .= "IF NOT EXISTS ";
        }

        /* Table Name */
        $query .= $this->tableName . " ";

        $query .= "(";

        /* Columns */
        $query .= $this->parseColumns();

        /* Constraints */
        $query .= $this->parseConstraints();

        $query .= ");";

        return $query;
    }

    /**
     * Create a string type column
     *
     * @param string $columnName
     * @param int $length
     * @return Blueprint
     */
    public function string(string $columnName, int $length = Blueprint::DEFAULT_STRING_LENGTH): Blueprint
    {
        return $this->baseTypeDeclaration($columnName, Blueprint::STRING_BASETYPE, $length);
    }

    /**
     * Create an int type column
     *
     * @param string $columnName
     * @param int $length
     * @return Blueprint
     */
    public function int(string $columnName, int $length = Blueprint::DEFAULT_INT_LENGTH): Blueprint
    {
        return $this->baseTypeDeclaration($columnName, Blueprint::INT_BASETYPE, $length);
    }

    /**
     * Set column not null
     *
     * @param array|string|null $columnNames
     * @return Blueprint
     */
    public function notNull($columnNames = null): Blueprint
    {
        return $this->constraintDeclaration(
            Blueprint::NOT_NULL,
            isset($columnNames) ? $columnNames : null
        );
    }

    /**
     * Set column as primary key
     *
     * @param array|string|null $columnNames
     * @return Blueprint
     */
    public function primary($columnNames = null): Blueprint
    {
        return $this->constraintDeclaration(
            Blueprint::PRIMARY_KEY,
            isset($columnNames) ? $columnNames : null
        );
    }

    /**
     * Set column as unique key
     *
     * @param array|string|null $columnNames
     * @return Blueprint
     */
    public function unique($columnNames = null): Blueprint
    {
        return $this->constraintDeclaration(
            Blueprint::UNIQUE,
            isset($columnNames) ? $columnNames : null
        );
    }

    /**
     * Set column as auto increment
     *
     * @param array|string|null $columnNames
     * @return Blueprint
     */
    public function autoIncrement($columnNames = null): Blueprint
    {
        return $this->constraintDeclaration(
            Blueprint::AUTO_INCREMENT,
            isset($columnNames) ? $columnNames : null
        );
    }

    /**
     * Create column
     *
     * @param string $columnName
     * @param string $baseType
     * @param int|null $length
     * @return Blueprint
     */
    private function baseTypeDeclaration(string $columnName, string $baseType, int $length = null): Blueprint
    {
        $this->mostRecentColumn = $columnName;

        $type = $baseType . '(';

        if (isset($length)) {
            $type .= (string)$length;
        }

        $type .= ')';

        $this->columns[$columnName] = [$type];

        return $this;
    }

    /**
     * Create constraint
     *
     * @param string $constraintType
     * @param array|string|null $columnNames
     * @return Blueprint
     */
    private function constraintDeclaration(string $constraintType, $columnNames = null): Blueprint
    {
        if (isset($columnNames)) {
            $this->constraints[$constraintType] = $columnNames;
        } elseif (isset($this->mostRecentColumn)) {
            $this->columns[$this->mostRecentColumn][] = $constraintType;
        }

        return $this;
    }

    /**
     * Parse columns to string
     *
     * @return string
     */
    private function parseColumns(): string
    {
        $columns = [];
        foreach ($this->columns as $field => $declaration) {
            $columns[] = $field . " " . implode(" ", $declaration);
        }

        return implode(", ", $columns);
    }

    /**
     * Parse constraints to string
     *
     * @return string
     */
    private function parseConstraints(): string
    {
        $constraints = [];
        foreach ($this->constraints as $constraint => $field) {
            $constraints[] = ($constraint . " (") . (is_array($field) ? implode(", ", $field) : $field) . ") ";
        }

        return $constraints ? ", " . implode(", ", $constraints) : '';
    }
}
