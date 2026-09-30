USE provinces_db;

SELECT 
    p.Id AS ProvinceId,
    p.Name AS ProvinceName,
    c.Id AS CityId,
    c.Name AS CityName,
    c.IsMain AS CityIsMain
FROM province p
JOIN city c ON (p.Id = c.ProvinceId)
ORDER BY p.Id, c.Id
