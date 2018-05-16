<?php

namespace Senhung\DB\Test\Database;

use Senhung\DB\Database\Connection;

\Senhung\DB\Test\indicate('Connection', 'Connect to MySQL database');

/* Create a default database connection */
$db = new Connection();

/* Test querying on the connection */
$result = $db->query('SHOW TABLES;', true);

/* See result */
print_r($result);

//$db2 = new Connection('ANOTHER');

//$result = $db2->query('SHOW TABLES;', true);

//print_r($result);
