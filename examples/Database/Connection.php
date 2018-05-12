<?php

namespace Senhung\MySQL\Test\Database;

use Senhung\MySQL\Database\Connection;

\Senhung\MySQL\Test\indicate('Connection', 'Connect to MySQL database');

$db = new Connection();

$result = $db->query('SHOW TABLES;', true);

print_r($result);

//$db2 = new Connection('ANOTHER');
//
//$result = $db2->query('SHOW TABLES;', true);
//
//print_r($result);
