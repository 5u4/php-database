<?php

namespace Senhung\MySQL\Test\Database;

use Senhung\MySQL\Database\Connection;

$result = Connection::query('SHOW TABLES;');

print_r($result);
