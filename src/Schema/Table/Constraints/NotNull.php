<?php

namespace Senhung\MySQL\Schema\Table\Constraints;

use Senhung\MySQL\Schema\Table\Prototypes\Constraint;

class NotNull extends Constraint
{
    protected $constraint = 'NOT NULL';
}
