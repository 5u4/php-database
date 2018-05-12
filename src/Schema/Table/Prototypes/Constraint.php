<?php

namespace Senhung\MySQL\Schema\Table\Prototypes;

class Constraint
{
    /** @var string|null $constraint */
    protected $constraint = null;
    /** @var string|null $column */
    protected $column = null;

    /**
     * Constraint constructor.
     * @param array|string|null $column
     */
    public function __construct($column = null)
    {
        $this->setColumn($column);
    }

    /**
     * @param array|string|null $column
     */
    private function setColumn($column): void
    {
        $this->column = gettype($column) == 'array' ? implode(', ', $column) : $column;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->column ? $this->constraint . " (" . $this->column . ")" : $this->constraint;
    }
}
