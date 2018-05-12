<?php

namespace Senhung\MySQL\Schema\Table\Constraints;

require_once 'Constraint.php';

class PrimaryKey extends Constraint
{
    protected $constraint = 'PRIMARY KEY';
}
