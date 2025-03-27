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

    /**
     * Get the value of id
     */
    public function getId():?int
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */
    public function getName():string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getContracts(): array
    {
        return $this->contracts;
    }

    public function addContract(Contract $contract) {
        $this->contracts[] = $contract;
    }
}