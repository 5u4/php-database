<?php

namespace Senhung\MySQL\Schema\Table\Constraints;

require_once 'Constraint.php';

class NotNull extends Constraint
{
    protected $constraint = 'NOT NULL';
}
