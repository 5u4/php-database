<?php

namespace Senhung\MySQL\Test\Schema;

use Senhung\MySQL\Schema\Blueprint;
use Senhung\MySQL\Schema\Schema;

\Senhung\MySQL\Test\indicate('Schema', '');

Schema::create('users', function (Blueprint $table) {
    $table->int('id')->primary()->autoIncrement();
    $table->string('name')->unique();
});
