<?php

namespace Senhung\MySQL\Schema\Table\Constraints;

use Senhung\MySQL\Schema\Table\Prototypes\Constraint;

class Unique extends Constraint
{
    protected $constraint = 'UNIQUE';
}
