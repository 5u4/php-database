<?php

namespace Senhung\MySQL\Test\Schema;

use Senhung\MySQL\Schema\Blueprint;

\Senhung\MySQL\Test\indicate('Blueprint', '');

$table = new Blueprint('users');

$table->int('someInt')->notNull()->primary();

$table->string('someStr')->notNull();

$table->unique(['someInt', 'someStr']);

print $table . "\n";
