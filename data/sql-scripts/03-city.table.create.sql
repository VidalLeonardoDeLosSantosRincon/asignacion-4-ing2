USE provinces_db;

CREATE TABLE city (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    IsMain BIT NOT NULL DEFAULT 0,
    ProvinceId INT NOT NULL,
    CONSTRAINT fk_city_province
    FOREIGN KEY (ProvinceId)
    REFERENCES Province(Id)
);
