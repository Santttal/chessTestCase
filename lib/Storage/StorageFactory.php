<?php

namespace Chess\Lib\Storage;

class StorageFactory
{
    /**
     * @param string $type
     * @return Storage
     */
    public static function create($type)
    {
        switch ($type) {
            case Storage::REDIS_TYPE:
                $storage = new RedisStorage();
                break;

            case Storage::FILE_TYPE:
                $storage = new FileStorage();
                break;
            default:
                throw new \InvalidArgumentException("Can't create storage with type: " . $type);
        }

        return $storage;
    }
}
