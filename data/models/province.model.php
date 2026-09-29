<?php
class Province
{
    public array $cities;

    public function __construct(
        public int $id,
        public string $name
    ) {
        $this->cities = [];
    }
}
?>