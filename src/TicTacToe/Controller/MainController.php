<?php

namespace TicTacToe\Controller;


use TicTacToe\Model\BoardModel;
use TicTacToe\Model\Exception\NoWinnerException;
use TicTacToe\Model\Exception\WinnerFound;

/**
 * Class MainController
 * @package TicTacToe\Controller
 */
class MainController
{
    /**
     * @var BoardModel
     */
    private $boardModel;

    /**
     * MainController constructor.
     * @param BoardModel $boardModel
     */
    public function __construct(BoardModel $boardModel)
    {
        $this->boardModel = $boardModel;
    }

    /**
     * @return iterable
     */
    public function indexAction(): iterable
    {
        if (!$this->boardModel->getBoard()) {
            $this->boardModel->clear();
        }

        return $this->prepareResponse();
    }

    /**
     * @param int $x
     * @param int $y
     * @return iterable
     */
    public function setSignAction(int $x, int $y): iterable
    {
        $result = false;
        try {
            $this->boardModel->applyNewSign($x, $y, $this->boardModel->getNextSign());
        } catch (WinnerFound|NoWinnerException $e) {
            $result = $e->getMessage();
        }

        return $this->prepareResponse($result);
    }

    public function clearAction(): void
    {
        $this->boardModel->clear();
    }

    /**
     * @param null|string $message
     * @return iterable
     */
    protected function prepareResponse(string $message = ''): iterable
    {
        return [
            'board' => $this->boardModel->getBoard(),
            'result' => $message,
        ];
    }
}