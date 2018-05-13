<?php

namespace Senhung\MySQL\Test\Database;

use Senhung\MySQL\Database\QueryBuilder;

\Senhung\MySQL\Test\indicate('QueryBuilder', 'Build queries');

$query = new QueryBuilder();

$query->select('*')->from('users');

print $query . "\n";
