<?php

namespace Senhung\MySQL\Schema\Table\DataTypes;

use Senhung\MySQL\Schema\Table\Prototypes\DataType;

class Integer extends DataType
{
    protected $type = "INT";
    protected $length = 15;
}
