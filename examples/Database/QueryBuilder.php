<?php

namespace Senhung\MySQL\Test\Database;

use Senhung\MySQL\Database\QueryBuilder;
use Senhung\MySQL\Schema\Table\Column;
use Senhung\MySQL\Schema\Table\Constraints\NotNull;
use Senhung\MySQL\Schema\Table\Constraints\PrimaryKey;
use Senhung\MySQL\Schema\Table\DataTypes\Integer;

\Senhung\MySQL\Test\indicate('QueryBuilder', 'Build queries');

$createTable = new QueryBuilder();

$createTable->createTable('user')->definition([
    new Column('id', new Integer()),
    new Column('name', new Integer(20), new NotNull()),
], [
    new PrimaryKey('id')
]);

print $createTable;

print "\n";
