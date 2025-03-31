<?php

namespace App\Model;

class ContractPrice
{
    //declaration propriétés directes dans le constructeur
    public function __construct(
        private ?int $id,
        private float $price,
        private string $vehicleType,
        private ?Contract $contract
    ) {
        $this->id = $id;
        $this->price = $price;
        $this->vehicleType = $vehicleType;
        $this->contract = $contract;
    }
    //getter & setter all
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
    public function getVehicleType(): string
    {
        return $this->vehicleType;
    }
    public function setVehicleType(string $vehicleType): void
    {
        $this->vehicleType = $vehicleType;
    }

    public function getContract(): ?Contract
    {
        return $this->contract;
    }

    public function setContract(?Contract $contract)
    {
        $this->contract = $contract;

        return $this;
    }
}

