<?php
namespace TicTacToe;

use TicTacToe\Controller\MainController;
use TicTacToe\Model\BoardModel;
use TicTacToe\Resources\BoardStorage\SessionBoardStorage;

/**
 * Class Application
 * @package TicTacToe
 */
class Application
{
    /**
     * @return iterable
     */
    public function handle(): iterable
    {
        $action = new MainController(new BoardModel(new SessionBoardStorage()));
        if ($_GET['clear'] ?? false) {
            $action->clearAction();
        }
        if (empty($_POST)) {
            $result = $action->indexAction();
        } else {
            $result = $action->setSignAction($_POST['x'] ?? null, $_POST['y'] ?? null);
        }

        return $result;
    }
}