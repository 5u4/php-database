<?php

namespace Senhung\MySQL\Schema\Table;

use Senhung\MySQL\Schema\Table\Prototypes\Constraint;
use Senhung\MySQL\Schema\Table\Prototypes\DataType;

class Column
{
    /** @var string $name */
    private $name;
    /** @var DataType $type */
    private $type;
    /** @var array $constraints */
    private $constraints = [];

    /**
     * Column constructor.
     * @param string $name
     * @param DataType $type
     */
    public function __construct(string $name, DataType $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return trim($this->name . " " . $this->type . " " . implode(" ", $this->constraints));
    }

    /**
     * @param Constraint $constraint
     */
    public function addConstraint(Constraint $constraint)
    {
        $this->constraints[] = $constraint;
    }
}
