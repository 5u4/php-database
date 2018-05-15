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
     * Track the most recent editing column
     *
     * @var string $columnName
     */
    private $mostRecentColumn;

    /**
     * Track the most recent editing relationship
     *
     * @var string $mostRecentRelationship
     */
    private $mostRecentRelationship;

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
     * Foreign key constraints
     *
     * @var array $relationships
     */
    private $relationships = [];

    /**
     * Table options
     *
     * @var array $options
     */
    private $options = [];

    /**
     * Table building constants
     */
    private const DEFAULT_STRING_LENGTH = 50;
    private const DEFAULT_INT_LENGTH = 11;
    private const DEFAULT_TEXT_LENGTH = 65535;
    private const DEFAULT_FLOAT_LENGTH = 11;
    private const DEFAULT_FLOAT_DECIMALS = 2;
    private const DEFAULT_DOUBLE_LENGTH = 11;
    private const DEFAULT_DOUBLE_DECIMALS = 2;
    private const DEFAULT_DECIMAL_LENGTH = 11;

    /**
     * Base Types
     */
    private const STRING = 'VARCHAR';
    private const INT = 'INT';
    private const TEXT = 'TEXT';
    private const JSON = 'JSON';
    private const ENUM = 'ENUM';
    private const TIMESTAMP = 'TIMESTAMP';
    private const FLOAT = 'FLOAT';
    private const DOUBLE = 'DOUBLE';
    private const DECIMAL = 'DECIMAL';

    /**
     * Constraints
     */
    private const NOT_NULL = 'NOT NULL';
    private const NULL = 'NULL';
    private const PRIMARY_KEY = 'PRIMARY KEY';
    private const UNIQUE = 'UNIQUE';
    private const AUTO_INCREMENT = 'AUTO_INCREMENT';
    private const DEFAULT = 'DEFAULT';
    private const INDEX = 'INDEX';
    private const UNSIGNED = 'UNSIGNED';

    /**
     * Relationships
     */
    private const CONSTRAINT = 'CONSTRAINT';
    private const FOREIGN = 'FOREIGN KEY';
    private const REFERENCES = 'REFERENCES';
    private const ON_DELETE = 'ON DELETE';
    private const ON_UPDATE = 'ON UPDATE';
    public const RESTRICT = 'RESTRICT';
    public const CASCADE = 'CASCADE';
    public const SET_NULL = 'SET NULL';
    public const NO_ACTION = 'NO ACTION';
    public const SET_DEFAULT = 'SET DEFAULT';

    /**
     * Table Options
     */
    private const TABLE_AUTO_INCREMENT = 'AUTO_INCREMENT';
    private const CHARACTER_SET = 'CHARACTER SET';
    private const COMMENT = 'COMMENT';
    private const ENGINE = 'ENGINE';
    private const MAX_ROWS = 'MAX_ROWS';
    private const MIN_ROWS = 'MIN_ROWS';

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

    /* ---------------------------------------------------------------------------------
     | Data Types
     | ---------------------------------------------------------------------------------
     */

    /**
     * Create a string type column
     *
     * @param string $columnName
     * @param int $length
     * @return Blueprint
     */
    public function string(string $columnName, int $length = Blueprint::DEFAULT_STRING_LENGTH): Blueprint
    {
        return $this->baseTypeDeclaration($columnName, Blueprint::STRING, $length);
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
        return $this->baseTypeDeclaration($columnName, Blueprint::INT, $length);
    }

    /**
     * Create a text type column
     *
     * @param string $columnName
     * @param int $length
     * @return Blueprint
     */
    public function text(string $columnName, int $length = Blueprint::DEFAULT_TEXT_LENGTH): Blueprint
    {
        return $this->baseTypeDeclaration($columnName, Blueprint::TEXT, $length);
    }

    /**
     * Create a Json type column
     *
     * @param string $columnName
     * @return Blueprint
     */
    public function json(string $columnName): Blueprint
    {
        return $this->baseTypeDeclaration($columnName, Blueprint::JSON);
    }

    /**
     * Create an enum type column
     *
     * @param string $columnName
     * @param array $values
     * @return Blueprint
     */
    public function enum(string $columnName, array $values): Blueprint
    {
        return $this->baseTypeDeclaration($columnName, Blueprint::ENUM . "('" . implode("', '", $values) . "')");
    }

    /**
     * Create a timestamp type column
     *
     * @param string $columnName
     * @param int|null $fsp
     * @return Blueprint
     */
    public function timestamp(string $columnName, int $fsp = null): Blueprint
    {
        return $this->baseTypeDeclaration($columnName, Blueprint::TIMESTAMP, $fsp);
    }

    /**
     * Create a float type column
     *
     * @param string $columnName
     * @param int $length
     * @param int $decimals
     * @return Blueprint
     */
    public function float(
        string $columnName,
        int $length = Blueprint::DEFAULT_FLOAT_LENGTH,
        int $decimals = Blueprint::DEFAULT_FLOAT_DECIMALS
    ): Blueprint {
        return $this->baseTypeDeclaration($columnName, Blueprint::FLOAT, $length, $decimals);
    }

    /**
     * Create a double type column
     *
     * @param string $columnName
     * @param int $length
     * @param int $decimals
     * @return Blueprint
     */
    public function double(
        string $columnName,
        int $length = Blueprint::DEFAULT_DOUBLE_LENGTH,
        int $decimals = Blueprint::DEFAULT_DOUBLE_DECIMALS
    ): Blueprint {
        return $this->baseTypeDeclaration($columnName, Blueprint::DOUBLE, $length, $decimals);
    }

    /**
     * Create a decimal type column
     *
     * @param string $columnName
     * @param int $length
     * @param int|null $decimals
     * @return Blueprint
     */
    public function decimal(
        string $columnName,
        int $length = Blueprint::DEFAULT_DECIMAL_LENGTH,
        int $decimals = null
    ): Blueprint {
        return $this->baseTypeDeclaration($columnName, Blueprint::DECIMAL, $length, $decimals);
    }

    /* ---------------------------------------------------------------------------------
     | Constraints
     | ---------------------------------------------------------------------------------
     */

    /**
     * Set column not null
     *
     * @param array|string|null $columnNames
     * @return Blueprint
     */
    public function notNull($columnNames = null): Blueprint
    {
        return $this->constraintDeclaration(Blueprint::NOT_NULL, $columnNames);
    }

    /**
     * Set column null
     *
     * @param array|string|null $columnNames
     * @return Blueprint
     */
    public function null($columnNames = null): Blueprint
    {
        return $this->constraintDeclaration(Blueprint::NULL, $columnNames);
    }

    /**
     * Set column as primary key
     *
     * @param array|string|null $columnNames
     * @return Blueprint
     */
    public function primary($columnNames = null): Blueprint
    {
        return $this->constraintDeclaration(Blueprint::PRIMARY_KEY, $columnNames);
    }

    /**
     * Set column as unique key
     *
     * @param array|string|null $columnNames
     * @return Blueprint
     */
    public function unique($columnNames = null): Blueprint
    {
        return $this->constraintDeclaration(Blueprint::UNIQUE, $columnNames);
    }

    /**
     * Set column as auto increment
     *
     * @param array|string|null $columnNames
     * @return Blueprint
     */
    public function autoIncrement($columnNames = null): Blueprint
    {
        return $this->constraintDeclaration(Blueprint::AUTO_INCREMENT, $columnNames);
    }

    /**
     * Set column default value
     *
     * @param string $value
     * @param array|string|null $columnNames
     * @return Blueprint
     */
    public function default(string $value, $columnNames = null): Blueprint
    {
        return $this->constraintDeclaration(Blueprint::DEFAULT . "(" . (string)$value . ")", $columnNames);
    }

    /**
     * Set column as auto increment
     *
     * @param array|string|null $columnNames
     * @return Blueprint
     */
    public function index($columnNames = null): Blueprint
    {
        return $this->constraintDeclaration(Blueprint::INDEX, $columnNames);
    }

    /**
     * Set column as unsigned
     *
     * @param array|string|null $columnNames
     * @return Blueprint
     */
    public function unsigned($columnNames = null): Blueprint
    {
        return $this->constraintDeclaration(Blueprint::UNSIGNED, $columnNames);
    }

    /* ---------------------------------------------------------------------------------
     | Relationships
     | ---------------------------------------------------------------------------------
     */

    /**
     * CONSTRAINT ... FOREIGN KEY ...
     *
     * @param string $columnName
     * @param string|null $constraintName
     * @return Blueprint
     */
    public function foreign(string $columnName, string $constraintName = null): Blueprint
    {
        return $this->relationshipColumnDeclaration($columnName, $constraintName);
    }

    /**
     * REFERENCES ...
     *
     * @param string $foreignTable
     * @param string|null $foreignColumn
     * @return Blueprint
     */
    public function references(string $foreignTable, string $foreignColumn = null): Blueprint
    {
        $value = $foreignTable . ($foreignColumn ? "(" . $foreignColumn . ")" : '');

        return $this->relationshipConstraintDeclaration(Blueprint::REFERENCES, $value);
    }

    /**
     * ON DELETE ...
     *
     * @param string $action
     * @return Blueprint
     */
    public function onDelete(string $action): Blueprint
    {
        return $this->relationshipConstraintDeclaration(Blueprint::ON_DELETE, $action);
    }

    /**
     * ON UPDATE ...
     *
     * @param string $action
     * @return Blueprint
     */
    public function onUpdate(string $action): Blueprint
    {
        return $this->relationshipConstraintDeclaration(Blueprint::ON_UPDATE, $action);
    }

    /* ---------------------------------------------------------------------------------
     | Table Options
     | ---------------------------------------------------------------------------------
     */

    /**
     * Table option auto increment value
     *
     * @param int $value
     * @return Blueprint
     */
    public function tableAutoIncrement(int $value): Blueprint
    {
        return $this->optionDeclaration(Blueprint::TABLE_AUTO_INCREMENT, $value);
    }

    /**
     * Table option char set
     *
     * @param string $charsetName
     * @return Blueprint
     */
    public function characterSet(string $charsetName)
    {
        return $this->optionDeclaration(Blueprint::CHARACTER_SET, $charsetName);
    }

    /**
     * Table option comment
     *
     * @param string $comment
     * @return Blueprint
     */
    public function comment(string $comment)
    {
        return $this->optionDeclaration(Blueprint::COMMENT, $comment);
    }

    /**
     * Table option engine
     *
     * @param string $engineName
     * @return Blueprint
     */
    public function engine(string $engineName)
    {
        return $this->optionDeclaration(Blueprint::ENGINE, $engineName);
    }

    /**
     * Table option max rows
     *
     * @param int $value
     * @return Blueprint
     */
    public function maxRows(int $value)
    {
        return $this->optionDeclaration(Blueprint::MAX_ROWS, $value);
    }

    /**
     * Table option min rows
     *
     * @param int $value
     * @return Blueprint
     */
    public function minRows(int $value)
    {
        return $this->optionDeclaration(Blueprint::MIN_ROWS, $value);
    }

    /* ---------------------------------------------------------------------------------
     | Helper Functions
     | ---------------------------------------------------------------------------------
     */

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
        $query .= "`" . $this->tableName . "` ";

        $query .= "(\n";

        /* Columns */
        $query .= $this->parseColumns();

        /* Constraints */
        $query .= $this->parseConstraints();

        /* Relationships */
        $query .= $this->parseRelationships();

        $query .= "\n) ";

        /* Table Options */
        $query .= $this->parseOptions();

        $query .= ";";

        return $query;
    }

    /**
     * Create column
     *
     * @param string $columnName
     * @param string $baseType
     * @param int|null $length
     * @param int|null $decimal
     * @return Blueprint
     */
    private function baseTypeDeclaration(string $columnName, string $baseType, int $length = null, int $decimal = null): Blueprint
    {
        $this->mostRecentColumn = $columnName;

        $type = $baseType;

        if (isset($length)) {
            $type .= '(' . (string)$length . ($decimal ? ", " . (string)$decimal : '') . ')';
        }

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
     * Create relationship column
     *
     * @param string $columnName
     * @param string|null $constraintName
     * @return Blueprint
     */
    private function relationshipColumnDeclaration(string $columnName, string $constraintName = null): Blueprint
    {
        $this->mostRecentRelationship = $columnName;

        $this->relationships[$columnName] = [];

        if ($constraintName) {
            $this->relationships[$columnName][Blueprint::CONSTRAINT] = $constraintName;
        }

        return $this;
    }

    /**
     * Fill out relationship
     *
     * @param string $constraint
     * @param string $value
     * @return Blueprint
     */
    private function relationshipConstraintDeclaration(string $constraint, string $value): Blueprint
    {
        $this->relationships[$this->mostRecentRelationship][$constraint] = $value;

        return $this;
    }

    /**
     * Create table option
     *
     * @param string $option
     * @param string $value
     * @return Blueprint
     */
    private function optionDeclaration(string $option, $value): Blueprint
    {
        $this->options[$option] = $value;

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
            $columns[] = "\t`" . $field . "` " . implode(" ", $declaration);
        }

        return implode(", \n", $columns);
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
            $constraints[] = "\t" . $constraint . " (`" .
                (is_array($field) ? implode("`, `", $field) : $field) . "`)";
        }

        return $constraints ? ", \n" . implode(", \n", $constraints) : '';
    }

    /**
     * Parse relationships to string
     *
     * @return string
     */
    private function parseRelationships(): string
    {
        $relationships = [];

        foreach ($this->relationships as $localColumn => $constraints) {
            $relationship = "\t";

            /* CONSTRAINT ... */
            if (isset($constraints[Blueprint::CONSTRAINT])) {
                $relationship .= Blueprint::CONSTRAINT . " " . $constraints[Blueprint::CONSTRAINT] . " ";
            }

            /* FOREIGN KEY ... */
            $relationship .= Blueprint::FOREIGN . " (" . $localColumn . ") ";

            /* REFERENCES ... */
            $relationship .= Blueprint::REFERENCES . " " . $constraints[Blueprint::REFERENCES] . " ";

            /* ON DELETE ... */
            if (isset($constraints[Blueprint::ON_DELETE])) {
                $relationship .= Blueprint::ON_DELETE . " " . $constraints[Blueprint::ON_DELETE] . " ";
            }

            /* ON UPDATE ... */
            if (isset($constraints[Blueprint::ON_UPDATE])) {
                $relationship .= Blueprint::ON_UPDATE . " " . $constraints[Blueprint::ON_UPDATE] . " ";
            }

            $relationships[] = rtrim($relationship);
        }

        return ($relationships ? ", \n" : "") . implode(", \n", $relationships);
    }

    /**
     * Parse table options to string
     *
     * @return string
     */
    private function parseOptions(): string
    {
        $options = [];

        foreach ($this->options as $option => $value) {
            $options[] = $option . "=" . (is_string($value) ? "'" . $value . "'" : (string)$value);
        }

        return implode(" ", $options);
    }
}
