<?php

class Building {

    public $id;
    public $address;
    public $coordinate;

    /**
     * @return array
     */
    public static function getAll(): array
    {
        $db = Db::getPDO();
        $query = $db->prepare('
            SELECT id, address, CONCAT(X(coordinate), ",", Y(coordinate)) AS coordinate
            FROM buildings
        ');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

}
