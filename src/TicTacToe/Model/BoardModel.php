<?php

namespace TicTacToe\Model;

use TicTacToe\Resources\BoardStorage\SessionBoardStorage;
use TicTacToe\Resources\BoardStorageInterface;

/**
 * Class BoardModel
 * @package TicTacToe\Model
 */
class BoardModel
{
    /**
     * @var SessionBoardStorage|BoardStorageInterface
     */
    private $boardStorage;

    /**
     * @var
     */
    private $winnerService;

    /**
     * BoardModel constructor.
     * @param BoardStorageInterface $boardStorage
     */
    public function __construct(BoardStorageInterface $boardStorage)
    {
        $this->boardStorage = $boardStorage;
    }

    /**
     * Clear all board
     */
    public function clear(): void
    {
        $board = $this->getEmptyBoard();
        $this->boardStorage->saveBoard($board);
        $this->boardStorage->setNextSign(true);
    }

    /**
     * @param int $toX
     * @param int $toY
     * @param bool $value
     */
    public function applyNewSign(int $toX, int $toY, bool $value): void
    {
        $board = $this->setSign($toX, $toY, $value);
        $this->boardStorage->saveBoard($board);
        $this->getWinnerService()->checkWinner();
        $this->toggleSign();
    }

    /**
     * @return iterable
     */
    public function getBoard(): iterable
    {
        return $this->boardStorage->getBoard();
    }

    /**
     * @return bool
     */
    protected function toggleSign(): bool
    {
        return $this->boardStorage->setNextSign(!$this->boardStorage->getSign());
    }

    /**
     * @return WinnerService
     */
    protected function getWinnerService()
    {
        if (!$this->winnerService) {
            $this->winnerService = new WinnerService($this->boardStorage);
        }

        return $this->winnerService;
    }

    /**
     * @return bool
     */
    public function getNextSign(): bool
    {
        return $this->boardStorage->getSign();
    }

    /**
     * @param int|null $toX
     * @param int|null $toY
     * @param bool|null $value
     * @return iterable
     */
    protected function setSign(int $toX = null, int $toY = null, bool $value = null): iterable
    {
        $board = $this->boardStorage->getBoard() ?: [];
        for ($x = 1; $x<=3; $x++) {
            for ($y = 1; $y<=3; $y++) {
                if ($board[$x][$y] === null && $x == $toX && $y == $toY) {
                    $board[$x][$y] = $value;
                } elseif (!isset($board[$x][$y])) {
                    $board[$x][$y] = null;
                }
            }
        }

        return $board;
    }

    /**
     * @return iterable
     */
    protected function getEmptyBoard(): iterable
    {
        $board = $this->boardStorage->getBoard() ?: [];
        for ($x = 1; $x<=3; $x++) {
            for ($y = 1; $y<=3; $y++) {
                $board[$x][$y] = null;
            }
        }

        return $board;
    }
}