<?php

use Chess\Lib\ChessBoard;
use Chess\Lib\ChessFigure\ChessFigure;
use Chess\Lib\ChessFigure\King;
use Chess\Lib\ChessFigure\Pawn;
use Chess\Lib\ChessFigure\Queen;
use Chess\Lib\Exception\MissingFigureException;
use Chess\Lib\Storage\StorageFactory;
use Chess\Lib\Storage\Storage;

require 'vendor/autoload.php';

$storage = StorageFactory::create(Storage::REDIS_TYPE);

$board = new ChessBoard(10);

$board->addFigure(new Pawn(), 1, 1, function(ChessFigure $figure, $x, $y) {
    if ($figure instanceof Pawn) {
        echo "Pawn is added on chessboard ($x, $y)." . PHP_EOL;
    }
});
$board->addFigure(new King(), 2, 3);
$board->addFigure(new Queen(), 4, 4);

try {
    $board->moveFigure(2, 2, 6, 6);
} catch (MissingFigureException $e) {
    echo "Can't move figure." . PHP_EOL;
}
$board->moveFigure(1, 1, 6, 6);

$storage->save($board);

$boardFromStorage = $storage->load();
