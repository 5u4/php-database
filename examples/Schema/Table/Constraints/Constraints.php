<?php

namespace Senhung\MySQL\Test\Schema\Table;

use Senhung\MySQL\Schema\Table\Constraints\AutoIncrement;
use Senhung\MySQL\Schema\Table\Constraints\NotNull;
use Senhung\MySQL\Schema\Table\Constraints\PrimaryKey;
use Senhung\MySQL\Schema\Table\Constraints\Unique;

\Senhung\MySQL\Test\indicate('Constraints', 'MySQL constraints');

print new NotNull() . "\n";
print new AutoIncrement() . "\n";
print new PrimaryKey('username') . "\n";
print new Unique(['username', 'birth']) . "\n";
