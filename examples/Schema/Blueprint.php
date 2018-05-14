<?php

namespace Senhung\MySQL\Test\Schema;

use Senhung\MySQL\Schema\Blueprint;

\Senhung\MySQL\Test\indicate('Blueprint', '');

$table = new Blueprint('users');

$table->int('id')->notNull()->primary();

$table->string('someStr')->notNull()->default(20);

$table->enum('something', ['first', 'second']);

$table->timestamp('timestamp', 3);

$table->decimal('decimal', 2);

$table->double('double', 3, 1);

$table->unique(['id', 'someStr']);

$table->tableAutoIncrement(3);

$table->characterSet('utf8mb4');

print $table . "\n";
