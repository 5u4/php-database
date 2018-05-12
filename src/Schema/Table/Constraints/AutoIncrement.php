<?php

namespace Senhung\MySQL\Schema\Table\Constraints;

require_once 'Constraint.php';

class AutoIncrement extends Constraint
{
    protected $constraint = 'AUTO_INCREMENT';
}
