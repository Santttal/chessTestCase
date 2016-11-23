<?php

namespace Chess\Lib\Storage;

use Chess\Lib\ChessBoard;
use Redis;

class RedisStorage implements Storage
{
    const BOARD_REDIS_KEY = 'board';
    const REDIS_HOST = 'localhost';

    /**
     * @var Redis
     */
    private $client;

    public function __construct()
    {
        $this->client = new Redis();
        $this->client->pconnect(self::REDIS_HOST);

    }

    /**
     * @param ChessBoard $board
     */
    public function save(ChessBoard $board)
    {
        $this->client->set(self::BOARD_REDIS_KEY, serialize($board));
    }

    /**
     * @return ChessBoard
     */
    public function load()
    {
        return unserialize($this->client->get(self::BOARD_REDIS_KEY));
    }
}
