<?php
namespace App\Model;

class Insurance
{


    public function __construct(
        private ?int $id,
        private string $name
    ) {
        $this->id = $id;
        $this->name = $name;

    }
}