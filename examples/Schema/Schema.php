<?php

namespace Senhung\DB\Test\Schema;

use Senhung\DB\Schema\Blueprint;
use Senhung\DB\Schema\Schema;

\Senhung\DB\Test\indicate('Schema', '');

Schema::create('users', function (Blueprint $table) {
    $table->int('id')->primary()->autoIncrement();
    $table->string('name')->unique();
});
