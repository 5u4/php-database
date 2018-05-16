<?php

namespace Senhung\DB\Test\Database;

use Senhung\DB\Database\QueryBuilder;

\Senhung\DB\Test\indicate('QueryBuilder', 'Build queries');

/* Create a new query builder */
$query = new QueryBuilder();

/* Select all columns from users table */
$query->select('*')->from('users')->where(['name', '=', 'alex']);

print $query . "\n";

$query->clear();

/* Insert into table */
$query->insertInto('users', ['name'])->values(['alex']);

print $query . "\n";

$query->clear();

/* Another insert query */
$query->insertInto('users', ['name'])->select(['alex'])->select(['senhung']);

print $query . "\n";

$query->clear();

/* Update row in a table */
$query->update('users')->set(['name' => 'senhung'])->where(['name', '=', 'alex']);

print $query . "\n";

$query->clear();
