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

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */
    public function getName(): string
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

    public function getInsurance(): ?Insurance
    {
        return $this->insurance;
    }

    // Méthode pour ajouter un prix à ce contrat
    public function addPrice(ContractPrice $price): void {
        $this->prices[] = $price;
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



