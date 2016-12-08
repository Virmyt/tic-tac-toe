<?php

namespace TicTacToe\Resources\BoardStorage;

use TicTacToe\Model\Helper\BoardHelper;
use TicTacToe\Resources\BoardStorageInterface;
use TicTacToe\Resources\NextSignInterface;

/**
 * Class SessionBoardStorage
 * @package TicTacToe\Resources\BoardStorage
 */
class SessionBoardStorage implements BoardStorageInterface, NextSignInterface
{
    use BoardHelper;

    /**
     * @inheritdoc
     */
    public function getBoard(): iterable
    {
        if (!$_SESSION['board']) {
            $_SESSION['board'] = [];
        }

        return $_SESSION['board'];
    }

    /**
     * @inheritdoc
     */
    public function saveBoard(iterable $board): iterable
    {
        return $_SESSION['board'] = $board;
    }

    /**
     * @inheritdoc
     */
    public function getSign(): bool
    {
        if (!$this->isDefined($_SESSION['nextSign'])) {
            $_SESSION['nextSign'] = true;
        }
        return $_SESSION['nextSign'];
    }

    /**
     * @inheritdoc
     */
    public function setNextSign(bool $sign): bool
    {
        $_SESSION['nextSign'] = $sign;

        return $_SESSION['nextSign'];
    }
}