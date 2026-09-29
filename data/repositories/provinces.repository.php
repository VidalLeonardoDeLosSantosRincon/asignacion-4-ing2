<?php
require_once __DIR__ . '/../models/city.model.php';
require_once __DIR__ . '/../models/province.model.php';

class PronvinceRepository 
{
    function __construct(private PDO $connection)
    {
        
    }

    public function getAll(string $searchTerm = ""): array
    {
        $query = "SELECT 
                p.Id AS ProvinceId,
                p.Name AS ProvinceName,
                c.Id AS CityId,
                c.Name AS CityName,
                c.IsMain AS CityIsMain
            FROM province p
            JOIN city c ON (p.Id = c.ProvinceId)
            WHERE :search = ''
                OR (
                    LOWER(p.Name) LIKE :search
                    OR LOWER(c.Name) LIKE :search
                ) 
            ";

        $stmt = $this->connection->prepare($query);

        $search = '%' . strtolower($searchTerm) . '%';
        $stmt->execute(["search" => $search]);

        $provinces = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            if(!isset($provinces[$row['ProvinceId']])) {
                 $province = new Province(
                    $row['ProvinceId'],
                    $row['ProvinceName']
                );

                array_push($province->cities, new City(
                    $row['CityId'],
                    $row['CityName'],
                    $row['CityIsMain'],
                    $row['ProvinceId']
                ));

                $provinces[$row['ProvinceId']] = $province;
            } else {
                array_push($provinces[$row['ProvinceId']]->cities, new City(
                    $row['CityId'],
                    $row['CityName'],
                    $row['CityIsMain'],
                    $row['ProvinceId']
                ));
            }
        }

        return $provinces;
    }
}
    