<?php
class City
{
    public function __construct(
        public int $id,
        public string $name,
        public int $is_main,
        public int $province_id
    ) {

    }
}
?>