<?php

namespace TicTacToe\Model\Entity;

use TicTacToe\Model\Helper\BoardHelper;

/**
 * Class LineEntity
 * @package TicTacToe\Model\Entity
 */
class LineEntity
{
    use BoardHelper;

    const TYPE_VERTICAL = 'vertical';
    const TYPE_HORIZONTAL = 'horizontal';
    const TYPE_DIAGONAL = 'diagonal';

    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $lineNumber;

    /**
     * @var int
     */
    private $elementsCount = 0;

    /**
     * @var bool
     */
    private $sign;

    /**
     * LineEntity constructor.
     * @param string $type
     * @param int $lineNumber
     */
    public function __construct(string $type, int $lineNumber)
    {
        $this->type = $type;
        $this->lineNumber = $lineNumber;
    }

    /**
     * @param bool $sign
     * @return $this
     */
    public function incrementElementCount(bool $sign)
    {
        if ($this->sign === null) {
            $this->sign = $sign;
        }
        if ($this->sign === $sign) {
            $this->elementsCount++;
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getElementsCount(): int
    {
        return $this->elementsCount;
    }

    /**
     * @return bool
     */
    public function getLineSign(): bool
    {
        return $this->sign;
    }
}