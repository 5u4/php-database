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
     * @param Constraint|array $constraint
     */
    public function __construct(string $name, DataType $type, $constraint = [])
    {
        $this->name = $name;
        $this->type = $type;
        gettype($constraint) == 'object' ?
            $this->constraints = [$constraint] :
            $this->constraints = $constraint;
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
