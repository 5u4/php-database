<?php

namespace Senhung\DB\Test\Database;

use Senhung\DB\Database\QueryBuilder;

\Senhung\DB\Test\indicate('QueryBuilder', 'Build queries');

$query = new QueryBuilder();

$query->select('*')->from('users');

print $query . "\n";
