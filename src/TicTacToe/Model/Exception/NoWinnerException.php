<?php

namespace TicTacToe\Model\Exception;

/**
 * Class NoWinnerException
 * @package TicTacToe\Model\Exception
 */
class NoWinnerException extends \Exception
{
    /**
     * NoWinnerException constructor.
     * @param bool $winner
     */
    public function __construct()
    {
        $this->message = 'There is no winner';
        $this->code = 200;
    }

}