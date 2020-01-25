<?php

class Company {

    public $id;
    public $buildingId;
    public $name;

    /**
     * @param int $buildingId
     * @return array
     */
    public static function getByBuildingId(int $buildingId): array
    {
        $db = Db::getPDO();
        $query = $db->prepare('
            SELECT c.*
            FROM companies AS c
            LEFT JOIN buildings AS b ON c.buildingId = b.id
            WHERE b.id = ?;
        ');
        $query->execute([$buildingId]);
        return $query->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    /**
     * @param int $categoryId
     * @return array
     */
    public static function getByCategoryId(int $categoryId): array
    {
        $db = Db::getPDO();
        $query = $db->prepare('
            SELECT c.*
            FROM companies AS c
            LEFT JOIN companyCategories AS cc ON cc.companyId = c.id
            LEFT JOIN categories AS cat ON cat.id = cc.categoryId
            WHERE cat.id = ?;
        ');
        $query->execute([$categoryId]);
        return $query->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @param int $distance
     * @return array
     */
    public static function getByCoordinate(float $latitude, float $longitude, int $distance): array
    {
        $db = Db::getPDO();
        $query = $db->prepare('
            SELECT c.*, ST_Distance_Sphere(POINT(:latitude, :longitude), coordinate) AS distance
            FROM companies AS c
            LEFT JOIN buildings AS b ON b.id = c.buildingId
            HAVING distance < :distance
            ORDER BY distance
        ');
        $query->execute([
            'latitude' => $latitude,
            'longitude' => $longitude,
            'distance' => $distance,
        ]);
        return $query->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

}
