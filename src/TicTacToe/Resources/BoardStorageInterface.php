<?php

namespace TicTacToe\Resources;

/**
 * Interface BoardStorageInterface
 * @package TicTacToe\Resources
 */
interface BoardStorageInterface
{
    /**
     * @return iterable
     */
    public function getBoard(): iterable;

    /**
     * @param iterable $board
     * @return iterable
     */
    public function saveBoard(iterable $board): iterable;
}