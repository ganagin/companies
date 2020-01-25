<?php

class Db {

    private static $dsn;
    private static $user;
    private static $password;
    private static $pdo;

    /**
     * @param string $dsn
     * @param string $user
     * @param string $password
     */
    public static function config(string $dsn, string $user, string $password)
    {
        static::$dsn = $dsn;
        static::$user = $user;
        static::$password = $password;
    }

    /**
     * @return PDO
     */
    public static function getPDO(): PDO
    {
        try {
            if (!static::$pdo) {
                static::$pdo = new PDO(static::$dsn, static::$user, static::$password);
                static::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }

        return static::$pdo;
    }
}
