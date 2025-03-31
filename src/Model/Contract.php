<?php

namespace App\Model;

class Contract
{
    public function __construct(
       private ?int $id,
       private string $name,
       private ?Insurance $insurance,
       private array $prices,
    )
{
        $this->id = $id;
        $this->name = $name;
        $this->insurance = $insurance;
        $this->prices = $prices;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getInsurance(): ?Insurance
    {
        return $this->insurance;
    }

    // Méthode pour ajouter un prix à ce contrat
    public function addPrice(ContractPrice $price): void {
        $this->prices[] = $price;
    }

    public function setPrices(array $prices): void {
        $this->prices = $prices;
    }

    // Méthode pour obtenir tous les prix associés à ce contrat
    public function getPrice(): array {
        return $this->prices;
    }

    public function setInsurance(?Insurance $insurance): void
    {
        $this->insurance = $insurance;
    }
}



