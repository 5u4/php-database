<?php

namespace Senhung\MySQL\Test\Schema;

use Senhung\MySQL\Database\Connection;
use Senhung\MySQL\Schema\Blueprint;

\Senhung\MySQL\Test\indicate('Blueprint', '');

$table = new Blueprint('users');

$table->int('id')->notNull()->primary();

$table->string('someStr')->notNull()->default(20);

$table->enum('something', ['first', 'second']);

$table->timestamp('timestamp', 3);

$table->decimal('num', 2, 3);

$table->unique(['someInt', 'someStr']);

print $table . "\n";
