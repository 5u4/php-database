<?php

namespace Senhung\MySQL\Schema\Table\Constraints;

use Senhung\MySQL\Schema\Table\Prototypes\Constraint;

class AutoIncrement extends Constraint
{
    protected $constraint = 'AUTO_INCREMENT';
}
