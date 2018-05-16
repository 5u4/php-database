<?php

namespace Senhung\DB\Test\Schema;

use Senhung\DB\Schema\Blueprint;
use Senhung\DB\Schema\Schema;

\Senhung\DB\Test\indicate('Schema', 'Create/Drop Table');

/* Create a table named 'users' with 'id' (int, primary key, auto increment) and 'name' (unique) */
Schema::create('users', function (Blueprint $table) {
    $table->int('id')->primary()->autoIncrement();
    $table->string('name')->unique();
});

/* Drop the table named 'users' */
Schema::drop('users');
