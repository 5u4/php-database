<?php

namespace Senhung\MySQL\Test\Schema\Table;

use Senhung\MySQL\Schema\Table\Column;
use Senhung\MySQL\Schema\Table\Constraints\NotNull;
use Senhung\MySQL\Schema\Table\DataTypes\Integer;

\Senhung\MySQL\Test\indicate('Column', 'MySQL column representation');

$column = new Column('name', new Integer());

$column->addConstraint(new NotNull());

print $column . "\n";
