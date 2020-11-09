<?php


namespace Core;


class App
{
    private static array $container = [];

    public static function bind($key, $value)
    {
        self::$container[$key] = $value;
    }

    public static function get($key)
    {
        if (!array_key_exists($key, self::$container)) {
            throw new \Exception("{$key} key not bounded to the container.");
        }

        return self::$container[$key];
    }
}