<?php

namespace Senhung\MySQL\Schema\Table\Prototypes;

class DataType
{
    /** @var string|null $constraint */
    protected $type = null;
    /** @var int|null $length */
    protected $length = null;

    /**
     * DataType constructor.
     * @param null $length
     */
    public function __construct($length = null)
    {
        if ($length) {
            $this->length = $length;
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return ($this->type ? $this->type : '') . ($this->length ? '(' . $this->length . ')' : '');
    }
}
