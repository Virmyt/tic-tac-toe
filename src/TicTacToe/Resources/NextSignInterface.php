<?php

namespace TicTacToe\Resources;

/**
 * Interface NextSignInterface
 * @package TicTacToe\Resources
 */
interface NextSignInterface
{
    /**
     * @return bool
     */
    public function getSign(): bool ;

    /**
     * @param bool $board
     * @return bool
     */
    public function setNextSign(bool $board): bool;
}