<?php

namespace Chess\Lib;

use Chess\Lib\ChessFigure\ChessFigure;
use Chess\Lib\Exception\BusyBoardCoordinates;
use Chess\Lib\Exception\InvalidBoardCoordinates;
use Chess\Lib\Exception\MissingFigureException;

class ChessBoard
{
    /**
     * @var ChessFigure[][]
     */
    private $figures = [];
    /**
     * @var int
     */
    private $size;

    /**
     * @param int $size
     */
    public function __construct($size)
    {
        $this->size = $size;
    }

    /**
     * @param ChessFigure $figure
     * @param int $x
     * @param int $y
     * @param string $userFunction
     */
    public function addFigure(ChessFigure $figure, $x, $y, $userFunction = null)
    {
        if ($x > $this->size || $y > $this->size || $x <= 0 || $y <=0) {
            throw new InvalidBoardCoordinates("Can't place figure with coords {$x}x{$y} on board with size {$this->size}");
        }

        if ($this->existsFigure($x, $y)) {
            throw new BusyBoardCoordinates("There is already a figure on {$x}x{$y}");
        }

        $this->figures[$x][$y] = $figure;
        if (!is_null($userFunction)) {
            call_user_func_array($userFunction, [$figure, $x, $y]);
        }
    }

    /**
     * @param int $x
     * @param int $y
     */
    public function removeFigure($x, $y)
    {
        if (!$this->existsFigure($x, $y)) {
            throw new MissingFigureException($x, $y);
        }

        unset($this->figures[$x][$y]);
    }

    /**
     * @param int $x
     * @param int $y
     * @return ChessFigure
     */
    public function getFigure($x, $y)
    {
        if (!$this->existsFigure($x, $y)) {
            throw new MissingFigureException($x, $y);
        }

        return $this->figures[$x][$y];
    }

    /**
     * @param int $x1
     * @param int $y1
     * @param int $x2
     * @param int $y2
     */
    public function moveFigure($x1, $y1, $x2, $y2)
    {
        $figure = $this->getFigure($x1, $y1);
        $this->addFigure($figure, $x2, $y2);
        $this->removeFigure($x1, $y1);
    }

    /**
     * @param int $x
     * @param int $y
     * @return bool
     */
    private function existsFigure($x, $y)
    {
        return isset($this->figures[$x][$y]);
    }
}
