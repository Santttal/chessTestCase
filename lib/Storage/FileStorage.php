<?php

namespace Chess\Lib\Storage;

use Chess\Lib\ChessBoard;

class FileStorage implements Storage
{
    const FILE_NAME = 'data/storage.data';
    /**
     * @param ChessBoard $board
     */
    public function save(ChessBoard $board)
    {
        file_put_contents(self::FILE_TYPE, serialize($board));
    }

    /**
     * @return ChessBoard
     */
    public function load()
    {
        return unserialize(file_get_contents(self::FILE_TYPE));
    }
}
