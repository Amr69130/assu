<?php
namespace App\Model;

class Insurance
{
    public function __construct(
        private ?int $id,
        private string $name,
        private array $contracts = [],
    ) {
        $this->id = $id;
        $this->name = $name;

    }

    public function getId():?int
    {
        return $this->id;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function setName($name): string
    {
        $this->name = $name;

        return $this;
    }

    public function getContracts(): array
    {
        return $this->contracts;
    }

    public function addContract(Contract $contract): void {
        $this->contracts[] = $contract;
    }
}