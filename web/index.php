<?php

include_once "../vendor/autoload.php";

session_start();

$app = new \TicTacToe\Application();
$templateData = $app->handle();

$board = $templateData['board'];
$result = $templateData['result'];
?>

<html>
<title>The game</title>
<head>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <script src="assets/main.js"></script>
</head>
<body>
<div class="grid">
    <?php for ($i = 1; $i <= 9; $i++): ?>
        <div
            onclick="sendSignLocation(this)"
            class="grid-element"
            data-x="<?= $x = ($i - 1) / 3 % 3 + 1?>"
            data-y="<?= $y = $i % 3 ?: 3?>"
        ><?= ($board[$x][$y] === false) ? 'O' : (($board[$x][$y] === true) ? 'X' : '') ?></div>
    <?php endfor; ?>
</div>
<div class="new-game" onclick="clearBoard(this)">New game</div>

<div class="result"><?= $result ?></div>
</body>
</html>
