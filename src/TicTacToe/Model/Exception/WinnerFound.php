<?php

namespace TicTacToe\Model\Exception;

/**
 * Class WinnerFound
 * @package TicTacToe\Model\Exception
 */
class WinnerFound extends \Exception
{
    /**
     * WinnerFound constructor.
     * @param bool $winner
     */
    public function __construct(?bool $winner = null)
    {
        $message = 'Winner is : ' . (($winner) ? 'X' : 'O');
        $this->message = $message;
        $this->code = 200;
    }

}