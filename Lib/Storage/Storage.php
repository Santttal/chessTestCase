<?php

namespace Chess\Lib\Storage;

use Chess\Lib\ChessBoard;

interface Storage
{
    const REDIS_TYPE = 'redis';
    const FILE_TYPE = 'file';

    /**
     * @param ChessBoard $board
     */
    public function save(ChessBoard $board);

    /**
     * @return ChessBoard
     */
    public function load();
}
