<?php

namespace Chess\Lib\Exception;

class MissingFigureException extends \RuntimeException
{
    const MESSAGE_TEMPLATE = "Figure missing on %sx%s";

    /**
     * @param int $x
     * @param int $y
     */
    public function __construct($x, $y)
    {
        $this->message = sprintf(self::MESSAGE_TEMPLATE, $x, $y);
    }
}
