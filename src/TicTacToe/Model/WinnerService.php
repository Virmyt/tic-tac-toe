<?php

namespace TicTacToe\Model;


use TicTacToe\Model\Entity\LineEntity;
use TicTacToe\Model\Exception\NoWinnerException;
use TicTacToe\Model\Exception\WinnerFound;
use TicTacToe\Model\Helper\BoardHelper;
use TicTacToe\Resources\BoardStorageInterface;

class WinnerService
{
    use BoardHelper;

    const MAX_LINE_ELEMENTS = 3;

    /**
     * @var BoardStorageInterface
     */
    private $boardStorage;

    /**
     * WinnerService constructor.
     * @param BoardStorageInterface $boardStorage
     */
    public function __construct(BoardStorageInterface $boardStorage)
    {
        $this->boardStorage = $boardStorage;
    }

    /**
     * @throws EndGameException
     */
    public function checkWinner()
    {
        $board = $this->boardStorage->getBoard() ?: [];
        /** @var LineEntity[] $lines */
        $lines = $this->buildLines($board);
        $totalSigns = $this->incrementAccouring($board, $lines);

        foreach ($lines as $line) {
            if ($line->getElementsCount() >= self::MAX_LINE_ELEMENTS) {
                throw new WinnerFound($line->getLineSign());
            }
        }

        if ($totalSigns === pow(self::MAX_LINE_ELEMENTS, 2)) {
            throw new NoWinnerException();
        }
    }

    /**
     * @param iterable $board
     * @return iterable
     */
    protected function buildLines(iterable $board): iterable
    {
        foreach ($board as $x => $yLine) {
            $lines['x_'.$x] = new LineEntity(LineEntity::TYPE_HORIZONTAL, $x);
            foreach ($yLine as $y => $value) {
                if ($x == 1) { // only for first line
                    $lines['y_'.$y] = new LineEntity(LineEntity::TYPE_VERTICAL, $y);
                    if ($y == 1) {
                        $lines['x_y'] = new LineEntity(LineEntity::TYPE_DIAGONAL, $y);
                    } elseif ($y == 3) {
                        $lines['y_x'] = new LineEntity(LineEntity::TYPE_DIAGONAL, $y);
                    }
                }
            }
        }
        asort($lines);

        return $lines;
    }

    /**
     * @param iterable $board
     * @param iterable|LineEntity[] $lines
     *
     * @return int
     */
    protected function incrementAccouring(iterable $board, iterable $lines): int
    {
        $total = 0;
        foreach ($board as $x => $yLine) {
            foreach ($yLine as $y => $value) {
                if ($this->isDefined($value)) {
                    $total++;
                    $lines['x_'.$x]->incrementElementCount($value);
                    $lines['y_'.$y]->incrementElementCount($value);
                    if ($x === $y) {
                        $lines['x_y']->incrementElementCount($value);
                    }
                    if ($x + $y === 4) { // coordinates: 1,3; 2,2; 3,1
                        $lines['y_x']->incrementElementCount($value);
                    }
                }
            }
        }

        return $total;
    }
}