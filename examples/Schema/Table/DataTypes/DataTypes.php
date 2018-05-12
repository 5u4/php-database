<?php

namespace Senhung\MySQL\Test\Schema\Table;

use Senhung\MySQL\Schema\Table\DataTypes\Integer;

\Senhung\MySQL\Test\indicate('DataTypes', 'MySQL data types');

print new Integer() . "\n";
print new Integer(20) . "\n";
