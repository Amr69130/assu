<?php
namespace App\Model;

class Coverage
{
    // Properties
    // private ?int $id;
    // private string $name;
    // private string $description;
    // private float $price;

    //declaration propriétés directes dans le constructeur
    public function __construct(
        private ?int $id,
        private string $name,
        private string $description,
        private float $price,
        private Contract $contract
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->contract = $contract;

    }

    // Getters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    // Setters


    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * Get the value of contract
     */
    public function getContract(): Contract
    {
        return $this->contract;
    }

    /**
     * Set the value of contract
     *
     * @return  self
     */
    public function setContract(Contract $contract)
    {
        $this->contract = $contract;

        return $this;
    }
}