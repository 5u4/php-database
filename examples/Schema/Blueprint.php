<?php

namespace Senhung\DB\Test\Schema;

use Senhung\DB\Schema\Blueprint;

\Senhung\DB\Test\indicate('Blueprint', '');

/* Create a new table named 'users' */
$table = new Blueprint('users');

/* Create an int column named 'id' which is a primary key and auto increases */
$table->int('id')->primary()->autoIncrement();

/* Create a string column named 'someStr' which is not null and has a default value of 20 */
$table->string('someStr')->notNull()->default(20);

/* Create an enum column named 'something' which can have value 'first'/'second' */
$table->enum('something', ['first', 'second']);

/* Create a timestamp column named 'timestamp' which has fsp of 3 */
$table->timestamp('timestamp', 3);

/* Create a decimal column named 'decimal' which have length of 2 */
$table->decimal('decimal', 2);

/* Create a double column named 'double' which have length 3 and decimal 1 */
$table->double('double', 3, 1);

/* Set 'id' and 'someStr' as a compound unique key */
$table->unique(['id', 'someStr']);

/* Create a foreign key of 'someStr' referencing primary key of 'other_table' */
$table->foreign('someStr')->references('other_table', 'column')
    /* having rules on delete cascade and on update cascade */
    ->onDelete(Blueprint::CASCADE)->onUpdate(Blueprint::CASCADE);

/* Create a foreign key of 'something' referencing 'its_column' on 'another_table' */
$table->foreign('something')->references('another_table', 'its_column');

/* Set table option auto increment to 3 */
$table->tableAutoIncrement(3);

/* Set table char set to 'utf8mb4' */
$table->characterSet('utf8mb4');

/* See create table query */
print $table . "\n";
