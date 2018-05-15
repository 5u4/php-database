<?php

namespace Senhung\DB\Test\Database;

use Senhung\DB\Database\Connection;

\Senhung\DB\Test\indicate('Connection', 'Connect to MySQL database');

$db = new Connection();

$result = $db->query('SHOW TABLES;', true);

print_r($result);

//$db2 = new Connection('ANOTHER');
//
//$result = $db2->query('SHOW TABLES;', true);
//
//print_r($result);
