<?php

class Db {

    private static $dsn;
    private static $user;
    private static $password;
    private static $pdo;

    public static function config(string $dsn, string $user, string $password)
    {
        static::$dsn = $dsn;
        static::$user = $user;
        static::$password = $password;
    }

    public static function getPDO(): PDO
    {
        try {
            if (!static::$pdo) {
                static::$pdo = new PDO(static::$dsn, static::$user, static::$password);
            }
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }

        return static::$pdo;
    }
}
