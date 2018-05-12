<?php

namespace Senhung\MySQL\Schema\Table\Constraints;

require_once 'Constraint.php';

class Unique extends Constraint
{
    protected $constraint = 'UNIQUE';
}
