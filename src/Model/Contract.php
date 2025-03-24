<?php
namespace App\Model;

class Contract
{


    public function __construct(
        private ?int $id,
        private string $name,
        private Insurance $insurance
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->insurance = $insurance;

    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */
    public function getName()
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
}