<?php

namespace Senhung\MySQL\Schema\Table;

use Senhung\MySQL\Schema\Table\Prototypes\Constraint;

class Column
{
    private $definition;

    private $constraints = [];



    public function __toString(): string
    {
        return $this->definition . implode(" ", $this->constraints);
    }

    public function addConstraint(Constraint $constraint)
    {
        $this->constraints[] = $constraint;
    }
}
