<?php

namespace TicTacToe\Model\Helper;

/**
 * Class BoardHelper
 * @package TicTacToe\Model\Helper
 */
trait BoardHelper
{
    /**
     * @param $element
     * @return bool
     */
    protected function isDefined($element): bool
    {
        return in_array($element, [true, false], true);
    }
}